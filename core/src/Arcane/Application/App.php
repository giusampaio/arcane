<?php

namespace Arcane\Application;

use Arcane\View\Template;
use Arcane\Autoload\Load as Load;
use Arcane\Http\Request as Request;

class App
{
	use \Arcane\Traits\Debug;
	use \Arcane\Traits\Resource;

	protected $load;

	/**
	 * Set load object on construct
	 */
	public function __construct()
	{
		$this->load = new Load();
	}

	/**
	 * Bootstrap application 
	 * 
	 * @return mixed
	 */
	public function run()
	{
		Load::registerAutoload();

		$this->setConsts();
		$this->setConfig();

		$starter = $this->starter();

		$layout  = $starter->layout;

		$view = $starter->view($layout);

		echo $view->render($starter);		
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
	public function setConfig()
	{
		// Get current project name
		$req = new Request();
		$project = strtolower($req->project());

		// Mount config.json path
		$file = ROOT_PATH . DS . $project . DS . 'starter' . DS . 'config.json';

		// Check if exists...
		if (! is_file($file) ) return false;

		//Open file and get content inside...
		$handler = fopen($file, 'r');
		$config  = fread($handler, filesize($file));

		define('CONFIG', $config);
	}
}