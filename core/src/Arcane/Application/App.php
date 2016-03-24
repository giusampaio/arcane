<?php

namespace Arcane\Application;

use Arcane\Autoload\Load as Load;
use Arcane\Http\Request as Request;

class App
{
	use \Arcane\Traits\Debug;

	/**
	 * Bootstrap application 
	 * 
	 * @return mixed
	 */
	public function run()
	{
		Load::registerAutoload();

		$this->setConsts();

		$project = ucfirst(Request::getProject());

		$namespace = "\\$project\\Starter\\";

		$class = Load::getClass($namespace, 'Index', null);

		$this->say($class);

		$class->process();
	}

	
	/**
	 * Set einvoirement constants
	 */
	public function setConsts()
	{
		$vendorDir = dirname(dirname(__FILE__));
		
		$baseDir = dirname($vendorDir);

		define('ARCANE_PATH', $baseDir);
		
		define('ROOT_PATH', realpath('.'));

		define('DS', DIRECTORY_SEPARATOR);
	}
}