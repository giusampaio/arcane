<?php

namespace {{projectName}}\Starter;

use Arcane\Layers\Controller;
use {{projectName}}\Starter\Controllers\Content;

class Index extends Controller
{

	public $layout = 'layout';


	public function getTitle()
	{
		return 'Welcome to the starter';
	}

	/**
	 * Endcut for rotines before processing a page
	 *	
	 * @return mixed 
	 */
	public function css()
	{
		return [];
	}

	/**
	 * Endcut for rotine on main process
	 * 
	 * @return mixed
	 */
	public function getContent()
	{
		return 'A great project was born right now!';
	}

	/**
	 * Endcut for rotines before processing a page
	 *	
	 * @return mixed 
	 */
	public function js()
	{
		return [];
	}
}