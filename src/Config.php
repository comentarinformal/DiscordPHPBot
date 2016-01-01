<?php

namespace Bot;

class Config
{
	/**
	 * Gets the config file.
	 *
	 * @param string $filename 
	 * @return array 
	 */
	public static function getConfig($filename = 'config.json')
	{
		$file = file_get_contents($_SERVER['PWD'] . '/' . $filename);

		return json_decode($file, true);
	}

	/**
	 * Saves the config file.
	 *
	 * @param array $config 
	 * @param string $filename
	 * @return array 
	 */
	public static function saveConfig($config, $filename = 'config.json')
	{
		$json = json_encode($config);
		
		file_put_contents($_SERVER['PWD'] . '/' . $filename, $json);

		return $json;
	}
}