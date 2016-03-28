<?php

namespace Arcane\Http;

class Request
{
	/*
		Tenta pegar o nome do projeto 
	*/
	public static function getProject()
	{
		if (isset($_REQUEST['project'])) {
			return $_REQUEST['project'];
		
		} else {
			return self::getProjectByFile();
		} 
	}

	/*
		Tenta pegar o nome do modulo do projeto 
	*/
	public static function getModule()
	{
		if (isset($_REQUEST['module']) ) {
			return $_REQUEST['module'];
		} else {
			return 'Hello';
		}
	}

	/**
	 * [getAction description]
	 * @return [type] [description]
	 */
	public static function getAction()
	{
	if (isset($_REQUEST['action']) ) {
			return $_REQUEST['action'];
		} else {
			return null;
		}	
	}

	/*
		Get default name project on config file
 	*/
	private static function getProjectByFile()
	{
		$file   = ROOT_PATH . DS . 'arcane.json';

		if (!file_exists($file)) {
			$msgError = "{Arcane Error} - Config file not found.";
			trigger_error($msgError, E_USER_ERROR);
		}
		
		$domain = $_SERVER['HTTP_HOST'];
		$config = json_decode(file_get_contents($file), true);

		$project = $config['projects'];

		if ( ! isset($project[$domain]) ) {
			$msgError = '{Arcane Error} - Project not found in config file.';	
			trigger_error($msgError, E_USER_ERROR); 
		}
		
		return $project[$domain];
	}
}