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

	$bot->addCommand('help', \Bot\Commands\Help::class, 1, 'Shows the help command.', '');
	$bot->addCommand('eval', \Bot\Commands\Evalu::class, 2, 'Evaluates some code.', '<code>');
	$bot->addCommand('join', \Bot\Commands\Join::class, 1, 'Joins the specified server.', '<invite>');
	$bot->addCommand('flush', \Bot\Commands\Flush::class, 2, 'Flushes the channels messages.', '[messages=15]');
	$bot->addCommand('info', \Bot\Commands\Info::class, 1, 'Shows information about the bot.', '');
	$bot->addCommand('meme', \Bot\Commands\Meme::class, 1, 'dank memes', '');
	$bot->addCommand('setlevel', \Bot\Commands\SetLevel::class, 2, 'Sets the auth level of a user.', '<user> [level=2]');
	$bot->addCommand('mylevel', \Bot\Commands\MyLevel::class, 0, 'Shows your auth level.', '');
	$bot->addCommand('setprefix', \Bot\Commands\SetPrefix::class, 2, 'Sets the prefix for the bot.', '<prefix>');
	$bot->addCommand('userinfo', \Bot\Commands\UserInfo::class, 1, 'Shows information about yourself or the specified user.', '[user]');
	$bot->addCommand('restart', \Bot\Commands\Restart::class, 2, 'Restarts the bot.', '');
	//$bot->addCommand('coinflip', \Bot\Commands\Coinflip::class, 1, 'Does a coinflip.', '');
	$bot->addCommand('8ball', \Bot\Commands\Eightball::class, 1, 'Magic 8 Ball!', '');
	$bot->addCommand('guilds', \Bot\Commands\Guilds::class, 1, 'Shows all the guilds.', '');
	$bot->addCommand('reload',\Bot\Commands\Reload::class,2,'Reloads all commands','');

	$commandResearch = glob('./src/Commands/*.php');
	$commandLoad = true;
	foreach($commandResearch as $file){
		include($file);
	}
	
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