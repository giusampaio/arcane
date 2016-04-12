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

		//
		$model = $this->getNamespace('model') . '\\' . ucfirst($nameController);

		//
		$saveController = $this->getUp($nameController);
		
		// args to send to handler replace on template
		$vars = ['nameController' => $nameController, 
				 'varController'  => strtolower($nameController),
				 'namespaceModel' => $model,
				 'namespace' 	  => $namespace,
				 'saveController' => $saveController];
		
		// get file name to the new controller
		$file = $this->getFileName($nameController, 'controller');

		// get content of template file
		$content = $this->fopenReplace($tpl, $vars);
	
		// Create file
		$this->fopenWrite($file, $content);
	} 	

	/**
	 * 
	 * 
	 * @return string
	 */
	public function getUp($model)
	{
		if (! isset($this->args['up']) || $this->args['up'] == null) {
			return null;
		}

		$up = '';

		foreach ($this->args['up'] as $arg) {

			$pieces = explode('.', $arg);

			$field    = $pieces[0]; 	
			$function = $pieces[1];

			$up .= PHP_EOL . '        '; 
			$up .= '$' . strtolower($model) .'->'. $field . ' = $this->post(\''. $field ."');";	
		}

		return $up;
	}
}