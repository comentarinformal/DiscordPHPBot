<?php

namespace Bot\Commands;

class Guilds
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
		$guilds = '';

		foreach ($discord->guilds as $guild) {
			$guilds .= "{$guild->name}, ";
		}

		$message->reply(rtrim($guilds, ', '));
	}
}