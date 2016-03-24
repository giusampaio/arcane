<?php

namespace Arcane\Console;

class Model
{
	private static $templateDir = __DIR__ . DS . 'Templates';

	private static $modelDir;

	private static $nameModel;

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

		$string = self::getContentModelFile();

		fwrite($handle, $string);

		return true;
	}

	/*

	 */
	public function getPathFile($params)
	{
		@list($project, $module, $nameModel) = explode('.', $params);

		self::$projectName = $project;

		$projectDir = strtolower($project) . DS;

		if (strtolower($module)=='starter' || !isset($nameModel)) {
			self::$modelDir  = 'starter' . DS . 'models';	
			self::$nameModel = $module;
		}  else {
			self::$modelDir = 'modules' . DS . ucfirst($module) . DS . 'models';	
			self::$nameModel = $nameModel;
		}
	
		self::$nameModel = ucfirst(self::$nameModel);

		$projectDir . self::$modelDir;
		
		$path = $projectDir . self::$modelDir . DS;

		if ( ! is_dir($path) ) mkdir($path);

		return $path . DS . self::$nameModel .'.php';
	}

	/*
	
	*/
	private static function getContentModelFile()
	{
		$file = self::$templateDir . DS .'Model.tpl';

		$content = fopen($file, 'r');

		$code = fread($content, filesize($file));

		$piece = ucfirst(str_replace(DS, '\\', self::$modelDir));
		
		$piece = ucfirst(str_replace('models', 'Models', $piece));

		$namespace = self::$projectName .'\\'. $piece;

		$code = str_replace('{{namespace}}', $namespace, $code);
		
		$code = str_replace('{{nameModel}}', ucfirst(self::$nameModel), $code);

		fclose($content);

		return $code;
	}
}