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
		$controllerName = ($this->vendor != null) ? $this->object : 'Config';

		//
		$model = $this->getNamespace('model') . '\\' . ucfirst($controllerName);

		//
		$saveController = $this->getUp($controllerName);
		
		// args to send to handler replace on template
		$vars = ['controllerName' => $controllerName, 
				 'varController'  => strtolower($controllerName),
				 'namespaceModel' => $model,
				 'namespace' 	  => $namespace,
				 'saveController' => $saveController];
		
		// get file name to the new controller
		$file = $this->getFileName($controllerName, 'controller');

		// get content of template file
		$content = $this->fopenReplace($tpl, $vars);
	
		// Create file
		$this->fopenWrite($file, $content);
	} 

	/**
	 * 
	 * @return [type] [description]
	 */
	public function module()
	{
		// Path to find controller service template
		$tpl  = $this->templateDir . DS .'Controllers'. DS .'Module.tpl';

		// If not a vendor, trait like a config starter controller...
		$controllerName = ($this->vendor != null) ? $this->object : 'Module';

		// Get a module namespace
		$moduleNamespace = $this->getModuleNamespace();

		// 
		$action = $this->getNamespace('controller') .'\\' . $this->module;

		//
		$saveController = $this->getUp($controllerName);
		
		// args to send to handler replace on template
		$vars = ['moduleNamespace'  => $moduleNamespace, 
				 'actionNamespace'  => $action];
		

		$file = strtolower($this->project . DS . 'modules' . DS . 
				$this->vendor . DS . $this->module) . DS . 'Module.php'; 

		// get content of template file
		$content = $this->fopenReplace($tpl, $vars);
	
		// Create file
		$this->fopenWrite($file, $content);	
	}

	/**
	 * Get a module controller namespace
	 * 
	 * @return string
	 */
	public function getModuleNamespace()
	{
		$namespace = $this->getNamespace('controller');

		$moduleNamespace = explode('\\', $namespace);

		array_pop($moduleNamespace);

		$moduleNamespace = implode('\\', $moduleNamespace);

		return $moduleNamespace;
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
			$up .= '$' . strtolower($model) .'->'. $field . ' = $post[\''. $field ."'];";	
		}

		return $up;
	}
}