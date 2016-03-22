<?php

namespace Arcane\Application;

use Arcane\Autoload\Load as Load;
use Arcane\Http\Request as Request;

class App
{
	/*
		Bootstrap do Framework
	*/
	public function run()
	{
		$this->setConsts();

		$project = ucfirst(Request::getProject());

		$namespace = "\\$project\\Starter\\";

		$class = Load::getClass($namespace, 'index', null);

		$class->process();
	}

	/*
		Define as constantes do sistema
	*/
	private function setConsts()
	{
		$vendorDir = dirname(dirname(__FILE__));
		
		$baseDir = dirname($vendorDir);

		define('ARCANE_PATH', $baseDir);
		
		define('ROOT_PATH', realpath('.'));

		define('DS', DIRECTORY_SEPARATOR);
	}
}