<?php

namespace Bot\Commands;

class MyLevel
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
		$userlevel = (isset($config['perms']['perms'][$message->author->id])) ? $config['perms']['perms'][$message->author->id] : 1;

		$message->reply("Your current level: {$config['perms']['levels'][$userlevel]}");
	}
}