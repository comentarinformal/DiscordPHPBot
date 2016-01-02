<?php

namespace Bot\Commands;

class Update
{
	/**
	 * Handles the message.
	 *
	 * @param Message $message 
	 * @param array $params
	 * @param Discord $discord 
	 * @param Config $config 
	 * @return void 
	 */
	public static function handleMessage($message, $params, $discord, $config)
	{
		$message->channel->sendMessage('Bot is going down for updates.');

		eval("git pull && (echo '{$config['sudo_pass']}' | sudo supervisorctl restart {$config['supervisor_process']})");
	}
}