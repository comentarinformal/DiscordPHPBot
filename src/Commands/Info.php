<?php

namespace Bot\Commands;

use Carbon\Carbon;
use Discord\Discord;

class Info
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
	public static function handleMessage($message, $params, $discord, $config)
	{
		$str  = "**DiscordPHP Bot**\r\n";
		$str .= "**Library:** _DiscordPHP_ ".Discord::VERSION."\r\n";

		$sha = substr(exec('git rev-parse HEAD'), 0, 6);

		$str .= "**Current Version:** `{$sha}`\r\n";
		$str .= "**PHP Version:** ".PHP_VERSION."\r\n";

		$uptime = Carbon::createFromTimestamp(DISCORDPHP_STARTTIME);

		$str .= "**Uptime:** {$uptime->diffForHumans()}\r\n";

		$str .= "\r\n**Author:** Uniquoooo `<@78703938047582208>`\r\n";

		$message->reply($str);	
	}
}