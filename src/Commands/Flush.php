<?php

namespace Bot\Commands;

class Flush
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
		$rmmessages = (isset($params[1])) ? $params[1] : 15;
		$channel = $message->channel;

		$channel->message_count = $rmmessages;

		foreach ($channel->messages as $key => $message) {
			$message->delete();
		}

		$message->reply("Flushed {$rmmessages} messages.");
	}
}