<?php

namespace Worknova\Panel\Address;

use Arcane\Layers\Controller;
use Worknova\Panel\Address\Controller\Address;

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
		$address = new Address();

		return $address->actions();			
	} 
}