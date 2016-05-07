<?php

namespace Worknova\Panel\Canvas;

use Arcane\Layers\Controller;
use Worknova\Panel\Canvas\Controller\Canvas;

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
		$canvas = new Canvas();

		return $canvas->actions();			
	} 
}