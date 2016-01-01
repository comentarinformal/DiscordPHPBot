<?php

use Discord\Discord;
use Discord\WebSockets\Event;
use Discord\WebSockets\WebSocket;

include 'vendor/autoload.php';
include 'commands.php';

echo "DiscordPHPBot".PHP_EOL;
echo "Loading config...".PHP_EOL;

try {
	$file = file_get_contents(__DIR__ . '/config.json');
	$config = json_decode($file);
} catch (\Exception $e) {
	echo "Unable to load config. {$e->getMessage()}".PHP_EOL;
	die(1);
}

echo "Loaded config file, initilizing Discord instance...".PHP_EOL;

try {
	$discord = new Discord($config->email, $config->password);
	$websocket = new WebSocket($discord);
} catch (\Exception $e) {
	echo "Unable to initilize Discord instance. {$e->getMessage()}".PHP_EOL;
	die(1);
}

echo "Initlized Discord. Logged in as:".PHP_EOL."Username: {$discord->username}".PHP_EOL."Mention: <@{$discord->id}>".PHP_EOL;
echo "Registering commands...".PHP_EOL;

$commands = [
	// command => functionName
	'help' => 'helpHandler'
];

foreach ($commands as $key => $function) {
	echo "Registering {$config->prefix}{$key}".PHP_EOL;

	$websocket->on(Event::MESSAGE_CREATE, function ($message, $discord, $newdiscord) use ($config, $key, $function) {
		if ($message->content == $config->prefix . $key) {
			call_user_func_array($function, [$message, $newdiscord, $commands]);
		}
	});
}

echo "Loaded all commands. Starting bot now...".PHP_EOL;

$websocket->run();