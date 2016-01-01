<?php

namespace Bot;

use Discord\Discord;
use Discord\WebSockets\Event;
use Discord\WebSockets\WebSocket;
use Illuminate\Support\Arr;

class Bot
{
	/**
	 * The Discord instance.
	 *
	 * @var Discord 
	 */
	protected $discord;

	/**
	 * The Discord WebSocket instance.
	 *
	 * @var WebSocket 
	 */
	protected $websocket;

	/**
	 * The list of commands.
	 *
	 * @var array 
	 */
	protected $commands = [];

	/**
	 * The config instance.
	 *
	 * @var Config 
	 */
	protected $config;

	/**
	 * Constructs the bot instance.
	 *
	 * @param Config $config
	 * @return void 
	 */
	public function __construct($config)
	{
		$this->discord = new Discord($config->email, $config->password);
		$this->websocket = new WebSocket($this->discord);	
		$this->config = $config;
	}

	/**
	 * Adds a command.
	 *
	 * @param string $command 
	 * @param string $class 
	 * @param integer $perms
	 * @return void 
	 */
	public function addCommand($command, $class, $perms)
	{
		$this->commands[$command] = [
			'perms' => $perms,
			'class' => $class
		];
	}

	/**
	 * Starts the bot.
	 *
	 * @return void 
	 */
	public function start()
	{
		set_error_handler(function ($errno, $errstr) {
			if (!(error_reporting() & $errno)) {
				return;
			}

			throw new \Exception($errstr, $errno);
		}, E_ALL);

		foreach ($this->commands as $command => $data) {
			$this->websocket->on(Event::MESSAGE_CREATE, function ($message, $discord, $new) use ($command, $data) {
				$content = explode(' ', $message->content);

				if ($content[0] == $this->config->prefix . $command) {
					Arr::forget($content, 0);
					$user_perms = @$this->config->perms->perms->{$message->author->id};

					if (empty($user_perms)) {
						$user_perms = $this->config->perms->default;
					}

					if ($user_perms >= $data['perms']) {
						try {
							$data['class']::handleMessage($message, $content, $discord, $this->config, $this);
						} catch (\Exception $e) {
							$message->reply("There was an error running the command. `{$e->getMessage()}`");
						}
					} else {
						$message->reply('You do not have permission to do this!');
						echo "[Auth] User {$message->author->username} blocked from running {$this->config->prefix}{$command}, <@{$message->author->id}>\r\n";
					}
				}
			});
		}

		$this->websocket->run();
	}

	/**
	 * Returns the list of commands.
	 *
	 * @return array 
	 */
	public function getCommands()
	{
		return $this->commands;	
	}
}