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

	/**
	 * [getModule description]
	 * @param  [type] $module [description]
	 * @return [type]         [description]
	 */
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
	 		return true;
		}

		return false;
	}


	/**
	 *	Load files in lowercase structure directory
	 *	
	 * @param  string $class Class with namespace 
	 * @return bool 
	 */
	private static function autoloadLowerCase($class) 
	{
		$namespace = explode('\\', $class);
		$class 	   = array_pop($namespace) . '.php';

		$path      = strtolower(implode('\\', $namespace));
		$file 	   = str_replace("\\", DS, $path . DS . $class);

		foreach (self::$prefix as $base) {

			$fullPath = $base . $file;

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