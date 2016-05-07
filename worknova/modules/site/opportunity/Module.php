<?php

namespace Worknova\Site\Opportunity;

use Arcane\Layers\Controller;
use Worknova\Site\Opportunity\Controller\Opportunity;

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
		$opportunity = new Opportunity();

		return $opportunity->actions();			
	} 
}