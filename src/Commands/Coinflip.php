<?php

namespace Bot\Commands;

class Coinflip
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
		$sides = ['Heads', 'Tails'];

		$message->reply($sides[array_rand($sides)]);
	}
}