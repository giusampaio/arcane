<?php

namespace Arcane\Http;

use Arcane\Http\Request;

class Router 
{

	/**
	 * Redirect to somewhere
	 * 
	 * @param  string $route Destiny to redirect
	 */
	public function go($route)
	{
		// Get object to parse URL 
		$request = new Request();

		// Get called module
		$project = $request->project();
		$vendor  = $request->vendor(); 
		$module  = $request->module(); 	

		$url = 'index.php?' .
			   'project=' . $project . 
			   '&action='. $route .
			   '&module='. $module .
			   '&vendor=' .$vendor;

		header('Location: '. $url);
	}
}