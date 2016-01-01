<?php

namespace Bot\Commands;

use Bot\Config;

class SetLevel
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
		if (isset($params[1])) {
			$level = (isset($params[2])) ? $params[2] : 2;
			$config['perms']['perms'][$params[1]] = $level;

			Config::saveConfig($config);

			$message->reply("Set user <@{$params[1]}> auth level to {$level}");
		}
	}
}