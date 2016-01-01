<?php

namespace Bot\Commands;

use Bot\Config;

class SetPrefix
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
		$prefix = (isset($params[1])) ? $params[1] : $config['prefix'];
		$config['prefix'] = $prefix;
		Config::saveConfig($config);

		$message->reply("Set the prefix to `{$prefix}`");
	}
}