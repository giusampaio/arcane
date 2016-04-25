<?php

namespace Arcane\Model\Model;

class Migrate
{

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
		Separar as definições
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

		return $path . DS . self::$controllerName .'.php';
	}
}