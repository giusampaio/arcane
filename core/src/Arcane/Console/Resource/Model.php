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
		$tpl  = $this->getTemplateFile('model');

		//If not a vendor, trait like a config starter model...
		$nameModel = ($this->vendor != null) ? $this->object : 'Config';
		
		// Get a ups to enchart to model class
		$up = $this->getUp();

		// args to send to handler replace on template
		$vars = ['nameModel' => $nameModel, 
				 'namespace' => $namespace,
				 'table'	 => strtolower($nameModel),	
				 'up'		 => $up];

		// get content of template file
		$content = $this->fopenReplace($tpl, $vars);
		
		// get file name to the new model
		$file = $this->getFileName($nameModel, 'model');
	
		$this->fopenWrite($file, $content);
	}

	/**
	 * 
	 * 
	 * @return array
	 */
	public function getUp()
	{
		if (! isset($this->args['up'])) return null;

		$up = '';

		foreach ($this->args['up'] as $arg) {

			$pieces = explode('.', $arg);

			$field    = $pieces[0]; 	
			$function = $pieces[1];

			$up .= PHP_EOL . '                            '; 
			$up .= '->'. $function . "('" . $field . "')";	
		}
		
		return $up;
	}
}