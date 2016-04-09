<?php

namespace Arcane\Console\Resource;

use Arcane\Console\Resource\Base;

class Controller extends Base
{
	/**
	 * Invoke a new controller to the project or module
	 * 
	 * @return boolean
	 */
	public function summon()
	{
		$this->call();
	}

	/**
	 * Create a Index Controller 
	 * 
	 * @return mixed
	 */
	public function index()
	{
		// Path to find controller index template
		$tpl  = $this->templateDir. DS .'Controllers'. DS .'Index.tpl';
		
		// Params to handle 
		$vars = ['projectName' => $this->project];

		$content = $this->fopenReplace($tpl, $vars);
		
		$file = strtolower($this->project) . DS . 'starter' . DS . 'Index.php'; 

		$this->fopenWrite($file, $content);
	}

	/**
	 * Create a Service Controller
	 * 
	 * @return mixed
	 */
	public function service()
	{
		$namespace = $this->getNamespace('controller');

		// Path to find controller service template
		$tpl  = $this->templateDir. DS .'Controllers'. DS .'Controller.tpl';

		//If not a vendor, trait like a config starter controller...
		$nameController = ($this->vendor != null) ? $this->object : 'Config';
		
		// args to send to handler replace on template
		$vars = ['nameController' => $nameController, 'namespace' => $namespace];
		
		// get file name to the new controller
		$file = $this->getFileName($nameController, 'controller');

		// get content of template file
		$content = $this->fopenReplace($tpl, $vars);
	
		$this->fopenWrite($file, $content);
	} 	
}