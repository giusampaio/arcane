<?php

namespace Arcane\Traits;

use Arcane\Http\Request;

trait Resource
{
	public function starter()
	{
		// Get object to parse URL 
		$request = new Request();

		// Get name of current project
		$project = $request->project();

		// Mount namespace
		$namespace = "\\$project\\Starter\\Index";

		// Return example of class
		return new $namespace();
	}


	/**
	 * 
	 * @param  [type] $namespace [description]
	 * @return [type]            [description]
	 */
	public function module($namespace = null)
	{
		if ($namespace != null) {
			return new $namespace();
		}

		// Get object to parse URL 
		$request = new Request();

		// Get called module
		$project = $request->project();
		$vendor  = $request->vendor(); 
		$module  = $request->module(); 	
		
		$namespace = "\\$project\\$vendor\\$module";

		return new $namespace();
	}
}