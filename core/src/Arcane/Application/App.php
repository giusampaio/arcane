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

		$this->setProjecConfig($project);

		$namespace = "\\$project\\Starter\\";

		$class = Load::getClass($namespace, 'Index', null);

		$class->process();
	}

	
	/**
	 * Set einvoirement constants
	 */
	public function setConsts()
	{
		$vendorDir = dirname(dirname(__FILE__));

		$baseDir = dirname($vendorDir);

		define('ARCANE_PATH', $vendorDir);
		
		define('ROOT_PATH', realpath('.'));

		define('DS', DIRECTORY_SEPARATOR);
	}

	/**
	 * Set configuration data of project 
	 * 
	 * @return mixed
	 */
	public function setProjecConfig($project)
	{
		$project = strtolower($project);

		$file = ROOT_PATH . DS . $project . DS . 'starter' . DS . 'config.json';

		if (! is_file($file) ) return false;

		$handler = fopen($file, 'r');

		$config  = fread($handler, filesize($file));

		define('CONFIG', $config);
	}
}