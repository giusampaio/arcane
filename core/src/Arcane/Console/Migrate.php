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
		@list($project, $module, $nameController) = explode('.', $params);

		self::$projectName = $project;

		$projectDir = strtolower($project) . DS;

		if (strtolower($module)=='starter' || !isset($nameController)) {
			self::$controllerDir  = 'starter' . DS . 'controllers';	
			self::$nameController = $module;
		}  else {
			self::$controllerDir = 'modules' . DS . ucfirst($module) . DS . 'controllers';	
			self::$nameController = $nameController;
		}
	
		self::$nameController = ucfirst(self::$nameController);

		$projectDir . self::$controllerDir;
		
		$path = $projectDir . self::$controllerDir . DS;

		return $path . DS . self::$nameController .'.php';
	}
}