<?php

namespace Bot;

class Config
{
	/**
	 * The Config object.
	 *
	 * @var object 
	 */
	protected $config;

	/**
	 * Loads the config file.
	 *
	 * @param string $filename 
	 * @return void 
	 */
	public function __construct($filename = 'config.json')
	{
		$file = file_get_contents($_SERVER['PWD'] . "/{$filename}");
		$this->config = json_decode($file);
	}

	/**
	 * Handles dynamic get calls to the class.
	 *
	 * @param string $var 
	 * @return mixed 
	 */
	public function __get($var)
	{
		return $this->config->{$var};
	}
}