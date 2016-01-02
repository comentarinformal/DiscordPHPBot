<?php

define('DISCORDPHP_STARTTIME', microtime(true));

use Bot\Bot;
use Bot\Config;
use Discord\Discord;

include 'vendor/autoload.php';

$opts = getopt('', ['config::']);
$configfile = (isset($opts['config'])) ? $opts['config'] : $_SERVER['PWD'] . '/config.json';

echo "DiscordPHPBot\r\n";
echo "Loading config file from {$configfile}\r\n";

try {
	echo "Initilizing the bot...\r\n";
	$bot = new Bot($configfile);
	echo "Initilized bot.\r\n";
} catch (\Exception $e) {
	echo "Could not initilize bot. {$e->getMessage()}\r\n";
	die(1);
}

try {
	echo "Loading commands...\r\n";

	$bot->addCommand('help', \Bot\Commands\Help::class, 1);
	$bot->addCommand('eval', \Bot\Commands\Evalu::class, 2);
	$bot->addCommand('join', \Bot\Commands\Join::class, 2);
	$bot->addCommand('flush', \Bot\Commands\Flush::class, 2);
	$bot->addCommand('info', \Bot\Commands\Info::class, 1);
	$bot->addCommand('meme', \Bot\Commands\Meme::class, 1);
	$bot->addCommand('setlevel', \Bot\Commands\SetLevel::class, 2);
	$bot->addCommand('mylevel', \Bot\Commands\MyLevel::class, 1);
	$bot->addCommand('setprefix', \Bot\Commands\SetPrefix::class, 2);
	$bot->addCommand('userinfo', \Bot\Commands\UserInfo::class, 1);

	echo "Loaded commands.\r\n";
} catch (\Exception $e) {
	echo "Could not load commands. {$e->getMessage()}\r\n";
	die(1);
}

try {
	echo "Starting the bot...\r\n";
	$bot->start();
} catch (\Exception $e) {
	echo "Error while running or starting the bot. {$e->getMessage()}\r\n";
	die(1);
}