<?php

namespace Bot\Commands;

class Evalu
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
		if (!isset($params[1])) {
			return;
		}
		
		try {
			eval('$response = '.implode(' ', $params).';');
			$message->reply("`{$response}`");
		} catch (\Exception $e) {
			$message->reply("Eval failed. {$e->getMessage()}");
		}
	}
}