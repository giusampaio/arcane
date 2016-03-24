<?php

namespace Arcane\Console;

class Project
{
	private static $templateDir = __DIR__ . DS . 'Templates';

	/*
		Cria a estrutura de diretórios de um novo projeto
	*/
	public static function init($project)
	{
		$dir = strtolower($project);

		if (self::hasProject($project)) {
			return  'Cannot redeclare project '. $project;
		}

		mkdir($dir) or die('Sem permissao de escrita');
	
		mkdir($dir. DS . 'modules');
		mkdir($dir. DS . 'starter');
		mkdir($dir. DS . 'starter' . DS .'assets');
		mkdir($dir. DS . 'starter' . DS .'controllers');
		mkdir($dir. DS . 'starter' . DS .'views');
		mkdir($dir. DS . 'starter' . DS .'models');	

		self::createIndex($dir, $project);

		return true;
	}

	/*
		Verifica se existe o projeto
	*/
	public static function hasProject($dir)
	{
		return (is_dir($dir)); 
	}

	/*

	*/
	private static function getContentIndexFile($projectName)
	{
		$file = self::$templateDir . DS .'Index.tpl';

		$content = fopen($file, 'r');

		$code = fread($content, filesize($file));

		$code = str_replace('{{projectName}}', $projectName, $code);

		fclose($content);

		return $code;
	}

	/*

	*/
	private static function createIndex($dir, $project)
	{
		$file   = 'Index.php';
	
		if (! $handle = fopen($dir.'/starter/'.$file, 'w')) {
			return 'You don\' have writing permission';
		} 

		$string = self::getContentIndexFile($project);

		fwrite($handle, $string);
	}
}