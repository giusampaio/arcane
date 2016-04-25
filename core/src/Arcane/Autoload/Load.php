<?php 

namespace Arcane\Autoload;

use Arcane\Http\Request; 

class Load
{
	use \Arcane\Traits\Debug;

	/**
	 * List with prefix namespaces
	 * 
	 * @var array
	 */
	protected static $prefix;

	/**
	 * Register Arcane Autoload
	 */
	public static function registerAutoload()
	{
		spl_autoload_register(array(__CLASS__, 'autoload'), true, true);		
	}

	/**
	 * Get a object class from project or Arcane Framework
	 * 
	 * @param  string $namespace Object's namespace 
	 * @param  string $class     Object's class
	 * @param  array  $params    Args for object construct 
	 * @return object            Object requested
	 */
	public static function getClass($namespace, $class, $params)
	{		
		$class = ucfirst($class);

		$namespace .= $class;

		return new $namespace($params);
	}

	/**
	 * Check if is a arcane file 
	 * 
	 * @param  string $namespace Object's namespace 
	 * @param  string $class     Object's class
	 * @return boolean           
	 */
	public static function is_arcane($namespace, $class)
	{
		$directory = str_replace('Arcane\\', '', $namespace);
		$directory = str_replace('\\', DS, $directory);

		$class = ucfirst($class);

		$file = ARCANE_PATH . DS . $directory . $class .'.php';
		
		return is_file($file);
	}

	public static function getModule($module = null)
	{
		$module = ( $module == null ) ? Request::getModule() : $module; 	

		$class   = ucfirst($module);
		$module  = ucfirst($module);
		$history = debug_backtrace();
		
		$lastClass = $history[1]['class'];

		$project = explode('\\', $lastClass)[0];

		$namespace = "\\$project\\Modules\\$module\\$class"; 

		return new $namespace();
	}

	public static function setPrefix($namespace, $base)
	{
		self::$prefix[$namespace] = $base;
	}
	
	private static function autoload($class)
	{
		self::setPrefix('Arcane',  ARCANE_PATH);
		self::setPrefix('Default', ROOT_PATH);

		if ( self::autoloadStarter($class) == true ) {
			return true;
		}

		if ( self::autoloadModule($class) == true ) {
			return true;
		}
	}

	private static function autoloadStarter($class) 
	{
		// Dismember namespace
		$namespace = explode('\\', $class);

		// Get only name class adding .php
		$class 	   = ucfirst(array_pop($namespace)) . '.php';

		// Mount file name and path name
		$path = strtolower(implode('\\', $namespace));
		$file = str_replace("\\", DS, $path . DS . $class);

		foreach (self::$prefix as $namespaceBase => $base) {

			$fullPath = $base . DS . $file; 	
			//print('<br/> PSR0 '. $fullPath);

			if ( is_file($fullPath) ) {
		 		require_once($fullPath);
		 		return true;
			} 	 	
		}

		return false;
	}

	private static function autoloadModule($class) 
	{
		// Dismember namespace
		$namespace = explode('\\', $class);

		if (! isset($namespace[1]) || $namespace[1] == 'Starter') return false;

		// Get only name class adding .php
		$class   = ucfirst(array_pop($namespace)) . '.php';
		$project = array_shift($namespace);
		$path    = $project .'\\modules\\'. implode('\\', $namespace);

		// Mount file name and path name
		$path = strtolower($path);
		$file = $path . DS . $class;
		
		foreach (self::$prefix as $namespaceBase => $base) {

			$fullPath = $base . DS . $file; 	

			//print('Module '.$fullPath .'<br/>');

			if ( is_file($fullPath) ) {
		 		require_once($fullPath);
		 		return true;
			} 	 	
		}

		return false;
	}
}