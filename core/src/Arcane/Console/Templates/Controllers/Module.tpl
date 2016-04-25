<?php

namespace {{moduleNamespace}};

use Arcane\Layers\Controller;
use {{actionNamespace}};

class Module extends Controller
{
	/**
	 * List all CSS files of the module
	 * 
	 * @return array
	 */
	public function css()
	{
		return [];
	}

	/**
	 * List all JS files of the module
	 * 
	 * @return array
	 */
	public function js()
	{
		return [];
	}

	/**
	 * Return the HTML content  of module 
	 * 
	 * @return string
	 */
	public function getContent()
	{
		${{varName}} = new {{controllerName}}();

		return ${{varName}}->actions();			
	} 
}