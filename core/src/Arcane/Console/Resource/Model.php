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
		$this->model();
	}


	/**
	 * Create a Service Model
	 * 
	 * @return mixed
	 */
	public function model()
	{
		$namespace = $this->getNamespace('model');

		// Path to find controller service template
		$tpl  = $this->templateDir. DS .'Models'. DS .'Model.tpl';

		//If not a vendor, trait like a config starter controller...
		$nameModel = ($this->vendor != null) ? $this->object : 'Config';
		
		// args to send to handler replace on template
		$vars = ['nameModel' => $nameModel, 'namespace' => $namespace];
		
		// get file name to the new model
		$file = $this->getFileName($nameModel, 'model');

		// get content of template file
		$content = $this->fopenReplace($tpl, $vars);
	
		$this->fopenWrite($file, $content);
	}

}