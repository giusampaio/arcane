<?php 

namespace Arcane\Autoload;

use Arcane\Http\Request; 

class Load
{
	use \Arcane\Traits\Debug;

	/**
	 * [$prefix description]
	 * @var [type]
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
	 * [getClass description]
	 * @param  [type] $namespace [description]
	 * @param  [type] $class     [description]
	 * @param  [type] $params    [description]
	 * @return [type]            [description]
	 */
	public static function getClass($namespace, $class, $params)
	{		
		$directory = str_replace('\\', DS, $namespace);
		
		$class = ucfirst($class);

		$file = ARCANE_PATH . DS . $directory . DS . $class .'.php';

		//die($file);

		if ( ! is_file($file) ) return false;

		$namespace .= $class;

		return new $namespace($params);
	}

	/**
	 * [getModule description]
	 * @param  [type] $module [description]
	 * @return [type]         [description]
	 */
	public static function getModule($module = null)
	{
		$module = ( $module == null ) ? Request::getModule() : $module; 	

		$class = ucfirst($module);

		$module = ucfirst($module);

		$history = debug_backtrace();
		
		$lastClass = $history[1]['class'];

		$project = explode('\\', $lastClass)[0];

		$namespace = "\\$project\\Modules\\$module\\$class"; 

		return new $namespace();
	}

	/**
	 * [setPrefix description]
	 * 
	 * @param [type] $namespace [description]
	 * @param [type] $base      [description]
	 */
	public static function setPrefix($namespace, $base)
	{
		self::$prefix[$namespace] = $base;
	}
	
	
	/**
	 * [autoload description]
	 * 
	 * @param  [type] $class [description]
	 * @return [type]        [description]
	 */
	private static function autoload($class)
	{
		$alias = self::getAliasNamespace($class);

		$class = ($alias == false) ? $class : $alias;

		self::setPrefix('Arcane',  ARCANE_PATH);
		self::setPrefix('Default', ROOT_PATH);

		if ( self::autoloadSimple($class) == true ) {
			return true;
		}

		if ( self::autoloadLowerCase($class) == true ) {
			return true;
		}

		if ( self::autoloadPSR0($class) == true ) {
			return true;
		}
	}

	/**
	 * [getAliasNamespace description]
	 * 
	 * @param  [type] $class [description]
	 * @return [type]        [description]
	 */
	private static function getAliasNamespace($class)
	{
		$alias['Model']      = 'Arcane\\Layers\\Model';
		$alias['Controller'] = 'Arcane\\Layers\\Controller';

		if ( isset($alias[$class]) ) {
			return $alias[$class];
		}

		return false;
	}

	

	
	private static function autoloadSimple($class)
	{
		$namespace = explode('\\', $class);

		$class 	   = array_pop($namespace) . '.php';

		$path      = strtolower(implode('\\', $namespace));

		$fullPath  = ROOT_PATH . DS . $path . DS . $class;  

		if(file_exists($fullPath)) {
		 		
	 		require_once($fullPath);
	 		print($fullPath . PHP_EOL);
	 		return true;
		}

		return false;
	}


	/*
		Load files in lowercase structure directory
	 
	  	@param  string $class
	  	@return bool
	*/
	private static function autoloadLowerCase($class) 
	{
		$namespace = explode('\\', $class);
		$class 	   = array_pop($namespace) . '.php';

		$path      = strtolower(implode('\\', $namespace));
		$file 	   = str_replace("\\", DS, $path . DS . $class);

		foreach (self::$prefix as $base) {

			$fullPath = $base . $file;

			print

			if( file_exists($fullPath) ) {
		 		
		 		require_once($fullPath);

		 		return true;
			}
		}

		return false;
	}

	/**
	 * [autoloadPSR0 description]
	 * @param  [type] $class [description]
	 * @return [type]        [description]
	 */
	private static function autoloadPSR0($class) 
	{
		$namespace = explode('\\', $class);
		$class 	   = ucfirst(array_pop($namespace)) . '.php';

		$path      = implode('\\', $namespace);
		$file 	   = str_replace("\\", DS, $path . DS . $class);

		foreach (self::$prefix as $namespaceBase => $base) {

			$fullPath = $base . DS . $file; 	

			if ( is_file($fullPath) ) {
		 		require_once($fullPath);
		 		return true;
			} 	 	
		}

		return false;
	}
}