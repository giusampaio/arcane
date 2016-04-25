<?php

namespace Arcane\Console;

class Controller
{
	private static $templateDir = __DIR__ . DS . 'Templates';

	private static $controllerDir;

	private static $controllerName;

	private static $projectName;

	/*

	*/
	public static function init($params)
	{
		if (!isset($params)) return 'Parameters not found';
	
		$file = self::getPathFile($params);

		if (! $handle = fopen($file, 'w')) {
			return 'You don\' have writing permission';
		} 

		$string = self::getContentControllerFile();

		fwrite($handle, $string);

		return true;
	}

	/*

	 */
	public function getPathFile($params)
	{
		@list($project, $module, $controllerName) = explode('.', $params);

		self::$projectName = $project;

		$projectDir = strtolower($project) . DS;

		if (strtolower($module)=='starter' || !isset($controllerName)) {
			self::$controllerDir  = 'starter' . DS . 'controllers';	
			self::$controllerName = $module;
		}  else {
			self::$controllerDir = 'modules' . DS . ucfirst($module) . DS . 'controllers';	
			self::$controllerName = $controllerName;
		}
	
		self::$controllerName = ucfirst(self::$controllerName);

		$projectDir . self::$controllerDir;
		
		$path = $projectDir . self::$controllerDir . DS;

		if ( ! is_dir($path) ) mkdir($path);

		return $path . DS . self::$controllerName .'.php';
	}

	/*
	
	*/
	private static function getContentControllerFile()
	{
		$file = self::$templateDir . DS .'Controller.tpl';

		$content = fopen($file, 'r');

		$code = fread($content, filesize($file));

		$piece = ucfirst(str_replace(DS, '\\', self::$controllerDir));
		
		$piece = ucfirst(str_replace('controllers', 'Controllers', $piece));

		$namespace = self::$projectName .'\\'. $piece;

		$code = str_replace('{{namespace}}', $namespace, $code);
		
		$code = str_replace('{{controllerName}}', ucfirst(self::$controllerName), $code);

		fclose($content);

		return $code;
	}
}