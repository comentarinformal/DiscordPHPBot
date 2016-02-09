<?php

namespace Bot\Commands;
if(isset($commandLoad) && $commandLoad == true){
	$bot->addCommand('meme', \Bot\Commands\Meme::class, 1, 'dank memes', '');
}
class Meme
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
		$memes = json_decode(file_get_contents('./command_files/dankmemes.json'),true);

		$message->reply($memes[array_rand($memes)]);
	}
}