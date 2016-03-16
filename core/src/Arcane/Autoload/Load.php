<?php 

namespace Arcane\Autoload;

use Arcane\Http\Request; 

class Load
{
	//
	protected static $prefix;

	/*
      Returns the encoding used by the Stringy object.
     
      @return string The current value of the $encoding property
     */
	public static function getClass($namespace, $class, $params)
	{
		spl_autoload_register(array(__CLASS__, 'autoload'), true, true);		
		
		$class = ucfirst($class);

		$namespace .= $class;

		return new $namespace($params);
	}

	/*
     	Carrega o modulo do projeto
     */
	public static function getModule($module = null)
	{
		spl_autoload_register(array(__CLASS__, 'autoload'), true, true);

		$module = ( $module == null ) ? Request::getModule() : $module; 	

		$class = ucfirst($module);

		$module = ucfirst($module);

		$history = debug_backtrace();
		
		$lastClass = $history[1]['class'];

		$project = explode('\\', $lastClass)[0];

		$namespace = "\\$project\\Modules\\$module\\$class"; 

		return new $namespace();
	}

	/*
	  	Load files in lowercase structure directory
	 
		@param  string $class
		@return bool
	*/
	public static function setPrefix($namespace, $base)
	{
		self::$prefix[$namespace] = $base;
	}
	
	
	/*
     	Autoload das aplicações gerenciadas pelo Arcane
     
     	@return string The current value of the $encoding property
     */
	private static function autoload($class)
	{
		self::setPrefix('Arcane', ROOT_PATH . DS . ARCANE_PATH);

		if ( self::autoloadSimple($class) == true ) {
			return true;
		}

		elseif ( self::autoloadLowerCase($class) == true ) {
			return true;
		}

		if ( self::autoloadPSR0($class) == true ) {
			return true;
		}
	}

	/*

	*/
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

		$file 	   = str_replace("\\", "/" , $path . DS . $class);

		foreach (self::$prefix as $base) {

			$fullPath = $base . $file;

			if( file_exists($fullPath) ) {
		 		
		 		require_once($fullPath);

		 		return true;
			}
		}

		return false;
	}

	/*
		Load files in lowercase structure directory
	 
		@param  string $class
		@return bool
	 */
	private static function autoloadPSR0($class) 
	{
		$namespace = explode('\\', $class);
		$class 	   = ucfirst(array_pop($namespace)) . '.php';

		$path      = implode('\\', $namespace);
		$file 	   = str_replace("\\", "/" , $path . DS . $class);

		foreach (self::$prefix as $namespaceBase => $base) {

			$fullPath = $base . $file; 	

			$namespaceBase = str_replace("\\", "/" , $namespaceBase);

			$fullPath = str_replace($namespaceBase, "" , $fullPath);

			if( file_exists($fullPath) ) {

		 		require_once($fullPath);

				return true;
		 	}	
		}

		return false;
	}
}