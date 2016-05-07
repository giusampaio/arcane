<?php

namespace Arcane\Http;

use Arcane\Http\Request;

class Router 
{
	use \Arcane\Traits\Resource;
	use \Arcane\Traits\Debug;

	/**
	 * Redirect to somewhere
	 * 
	 * @param  string $route Destiny to redirect
	 */
	public function go($route)
	{
		// Get object to parse URL 
		$request = new Request();

		$this->getSubDir();

		// Get called module
		$project = $request->project();
		$vendor  = $request->vendor(); 
		$module  = $request->module(); 	

		if ( $this->isVhost() == true ) {

			$url = $this->getSubDir() . '/' . $project. '/'. $vendor .'/'. $module . $route;

		} else {

			$url = 'index.php?' .
			   		'project=' . $project . 
			   		'&action='. $route .
			   		'&module='. $module .
			   		'&vendor=' .$vendor;
		}

		header('Location: '. $url);
	}

	public function getSubDir()
	{
		$pieces = explode('/', $_SERVER['PHP_SELF']);
		
		$final  = count($pieces) -1;
		$key    = array_search('public', $pieces);

		unset($pieces[0]);	

		for ($i=$key; $i <= $final; $i++) { 
			unset($pieces[$i]);
		}

		$subdir = '/'. implode('/', $pieces);

		return $subdir;
	}
}