<?php

namespace Worknova\Panel\Opportunity;

use Arcane\Layers\Controller;
use Worknova\Panel\Opportunity\Controller\Opportunity;

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

	public function menu()
	{
		return ['Oportunidades' => '/arcane/worknova/panel/opportunity/index'];
	}
}