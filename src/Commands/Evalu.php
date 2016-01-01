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

			if ($response == DISCORD_TOKEN) {
				$message->reply('Message contains token, not sent.');
				echo "[Security] Message contained token, not sent. Requested by {$message->author}\r\n";
				return;
			}

			$message->reply("`{$response}`");
		} catch (\Exception $e) {
			$message->reply("Eval failed. {$e->getMessage()}");
		}
	}
}