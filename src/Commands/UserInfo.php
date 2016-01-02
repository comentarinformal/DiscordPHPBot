<?php

namespace Bot\Commands;

use Discord\Helpers\Guzzle;
use Discord\Parts\User\User;

class UserInfo
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
		$id = (isset($params[1])) ? $params[1] : $message->author->id;

		if (preg_match('/<@(.+)>/', $id, $matches)) {
			$id = $matches[1];
		}

		$user = new User((array) Guzzle::get("users/{$id}"), true);

		$str  = "**{$user->username}:**\r\n";
		$str .= "**ID:** {$user->id}\r\n";
		$str .= "**Avatar URL:** {$user->avatar}\r\n";
		$str .= "**Discriminator:** {$user->discriminator}\r\n";
		$str .= "**Mention:** `{$user}`\r\n";

		$message->channel->sendMessage($str);
	}
}