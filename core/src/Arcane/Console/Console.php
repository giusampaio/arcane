<?php

namespace Arcane\Console;

use Arcane\Console\Project;

class Console 
{
	/*

	*/
	public static function initProject($project)
	{
		Project::init($project);
	}

	/*
		Cria o arquivo setup na raiz do projeto 
	*/
	public static function publishProject($project)
	{
		$file = 'setup-project.php';

		$handle = fopen($file, 'w') or die('Nao foi possivel criar arquivo de instalacao');

		$string = self::getContent();

		fwrite($handle, $string);
	}	

	/*
		
	*/
	public static function getContent()
	{
		$file = self::$templateDir . DS .'Install.tpl';

		$content = fopen($file, 'r');

		$code = fread($content, filesize($file));

		$code = str_replace('{{dependecies}}', 'Giuliano', $code);

		fclose($content);

		return $code;
	}
}