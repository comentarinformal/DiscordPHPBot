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

		foreach ($bot->getCommands() as $command => $data) {
			$str .= $command . ', ';
		}

		$message->reply(substr($str, 0, -2));
	}
}