<?php

namespace Arcane\Traits;

use Arcane\Http\Request;

trait Resource
{
	/**
	 * Return a starter project object
	 * 
	 * @return obj
	 */
	public function starter()
	{
		// Get object to parse URL 
		$request = new Request();

		// Get name of current project
		$project = ucfirst($request->project());

		// Mount namespace
		$namespace = "\\$project\\Starter\\Index";

		// Return example of class
		return new $namespace();
	}

	/**
	 * Check if is running on the arcane virtual host
	 */
	public function isVhost()
	{
		$dir = getcwd();

		$pieces = explode(DS, $dir);
		$index  = count($pieces) - 1;

		return ($pieces[$index] == 'public') ? true : false;
	}


	/**
	 * Return a object module given a name
	 * 
	 * @param  string $module Module's name
	 * @return mixed
	 */
	public function singleModule(string $module)
	{
		$request = new Request();	

		$project = ucfirst($request->project());
		$pieces  = explode('\\', $module);
		$class   = $pieces[1];

		$namespace = $project .'\\'. $pieces[0] .'\\'. $class .'\\'. 'Module';

		return new $namespace();
	}

	/**
	 * Return the current module parsed by URL
	 * 
	 * @return object
	 */
	public function currentModule()
	{
		// Get object to parse URL 
		$request = new Request();

		// Get called module
		$project = ucfirst($request->project());
		$vendor  = ucfirst($request->vendor()); 
		$module  = ucfirst($request->module()); 	
		
		$namespace = "\\$project\\$vendor\\$module\\Module";

		return new $namespace();
	}

	/**
	 * Return ALL object modules on the project
	 * Be careful to use this function!
	 * 
	 * @return array
	 */
	public function allModules(string $type = null)
	{
		$objs = [];

		$request = new Request();	

		$pathProject = ROOT_PATH . DS . $request->project() . DS . 'modules';

		$vendors = scandir($pathProject);

		foreach ($vendors as $vendor) {

			if ($vendor == '.' || $vendor == '..') continue;

			$modules = scandir($pathProject . DS . $vendor);
			
			if ($type != null && strtolower($type) != $vendor) continue;

			foreach ($modules as $module) {
				
				if ($module == '.' || $module == '..') continue;
				
				$namespace = ucfirst($vendor) .'\\'. ucfirst($module);

			
				$objs[] = $this->singleModule($namespace);		
			}
		}

		return $objs;
	}
}