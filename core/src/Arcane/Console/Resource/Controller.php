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
		// check type of controller...
		$type = (isset($this->args['type'])) ? $this->args['type'] : null;

		// execute function by type...
		if (method_exists($this, $type)) {
			call_user_func_array([$this, $type], []);
		}
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
		$namespace = $this->getNamespace();

		// Path to find controller service template
		$tpl  = $this->templateDir. DS .'Controllers'. DS .'Controller.tpl';

		//If not a vendor, trait like a config starter controller...
		$nameController = ($this->vendor != null) ? $this->object : 'Config';
		
		// args to send to handler replace on template
		$vars = ['nameController' => $nameController, 'namespace' => $namespace];
		
		// get file name to the new controller
		$file = $this->getFileName($nameController);

		// get content of template file
		$content = $this->fopenReplace($tpl, $vars);
	
		$this->fopenWrite($file, $content);
	}

	/**
	 * Recover namespace for service controller
	 * 
	 * @return string
	 */
	public function getNamespace()
	{	
		if (! isset($this->vendor) || $this->vendor == null) {
			$namespace = "$this->project\\Starter\\Controller";
		
		} else {
			$namespace = "\\$this->vendor\\$this->module\\$this->object"; 
		}

		return $namespace;
	} 

	/**
	 * Return file name to project 
	 * 
	 * @return string
	 */
	public function getFileName($name)
	{
		$file    = '%s'. DS .'starter'. DS .'controller'. DS .'%s.php'; 
		$file    = sprintf($file, strtolower($this->project), ucfirst($name));
		
		return $file;
	}	
}