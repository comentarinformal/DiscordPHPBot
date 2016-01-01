<?php

namespace Bot\Commands;

class Help
{
	/**
	 * Handles the message.
	 *
	 * @param Message $message 
	 * @param array $params
	 * @param Discord $discord 
	 * @param Config $config 
	 * @param Bot $bot 
	 * @return void 
	 */
	public static function handleMessage($message, $params, $discord, $config, $bot)
	{
		$str = '**Commands:** ';

		$user_level = (isset($config['perms']['perms'][$message->author->id])) ? $config['perms']['perms'][$message->author->id] : $config['perms']['default'];

		foreach ($bot->getCommands() as $command => $data) {
			if ($user_level >= $data['perms']) {
				$str .= $command . ', ';
			}
		}

		$message->reply(substr($str, 0, -2));
	}
}