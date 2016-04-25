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
	 * Get args to create a table on database
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

	/**
	 * Create and alter table on database 
	 * 
	 * @return boolean
	 */
	public function migrate()
	{
		// Get path to the modules
		$project	 = $this->project;
		$pathVendor  = strtolower($project . DS . 'modules');

		// Read the vendors dir
		$vendors = scandir($pathVendor);

		unset($vendors[0]);
		unset($vendors[1]);

		// Read all vendors and ...
		foreach ($vendors as $vendor) {

			// Catch path to find all modules by vendor
			$pathModule = $pathVendor . DS . $vendor;
			$modules    = scandir($pathModule); 

			unset($modules[0]);
			unset($modules[1]);

			// Read all modules and..
			foreach ($modules as $module) {

				// Catch path to find all models by models
				$pathModel = $pathModule . DS . $module . DS . 'model';
				$models    = scandir($pathModel);

				unset($models[0]);
				unset($models[1]); 	

				foreach ($models as $model) {

					$this->executeUp($vendor, $module, $model);
				}
			}
		}
	}

	/**
	 * Instance object and execute up function 
	 * 
	 * @param  string $vendor 
	 * @param  string $module 
	 * @param  string $model  
	 */
	private function executeUp($vendor, $module, $model)
	{
		$vendor = ucfirst($vendor);
		$module = ucfirst($module);
		$model  = ucfirst($model);

		$model = str_replace('.php', '', $model);

		$namespace = $this->project .'\\'. $vendor .'\\' . $module . '\\Model\\' . $model;

		$this->openConfigFile();

		$obj = new $namespace();

		if (method_exists($obj, 'up')) {
			$obj->up();
		}
	}

	/**
	 * Open config file to connect database 
	 */
	private function openConfigFile()
	{
		if (defined('CONFIG')) return false;

		$file = strtolower($this->project . DS . 'starter' .DS . 'config.json');

		if (! is_file($file)) {
			throw new Exception("Config file not found in the starter dir", 1);
		}

		$handler = fopen($file, 'r');
		$config  = fread($handler, filesize($file));

		define('CONFIG', $config);
	}
}