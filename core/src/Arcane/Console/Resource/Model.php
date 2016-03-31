<?php

namespace Arcane\Console\Resource;

use Arcane\Console\Resource\Base;

class Model extends Base
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
	 * Create a Service Model
	 * 
	 * @return mixed
	 */
	public function model()
	{
		$namespace = $this->getNamespace();

		// Path to find controller service template
		$tpl  = $this->templateDir. DS .'Models'. DS .'Model.tpl';

		//If not a vendor, trait like a config starter controller...
		$nameModel = ($this->vendor != null) ? $this->object : 'Config';
		
		// args to send to handler replace on template
		$vars = ['nameModel' => $nameModel, 'namespace' => $namespace];
		
		// get file name to the new controller
		$file = $this->getFileName($nameModel);

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
			$namespace = "$this->project\\Starter\\Model";
		
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
		$file    = '%s'. DS .'starter'. DS .'model'. DS .'%s.php'; 
		$file    = sprintf($file, strtolower($this->project), ucfirst($name));
		
		return $file;
	}	
}