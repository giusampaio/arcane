<?php

namespace {{projectName}}\Starter;

use Arcane\Layers\Controller;
use {{projectName}}\Starter\Controllers\Content;

class Index extends Controller
{
	/**
	 * View file from {{projectName}}
	 * 
	 * @var string
	 */
	public $layout = 'layout';

	/**
	 * List with all modules installed on {{projectName}}
	 * 
	 * @var array
	 */
	private $modules = [];

	/**
	 * 
	 */
	public function __construct()
	{
		$this->modules = $this->module('*');
	}

	/**
	 * Return title browser title 
	 * 
	 * @return string
	 */
	public function getTitle()
	{
		return 'Welcome to the starter';
	}

	/**
	 * Function to get all CSS files on project
	 *	
	 * @return mixed 
	 */
	public function css()
	{
		$files   = [];

		foreach ($this->modules as $module) {
			$files[] = $module->css();
		}

		return $this->assets('css', $files);
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
	 * Function to get all JS files on project
	 *	
	 * @return mixed 
	 */
	public function js()
	{
		$files   = [];

		foreach ($this->modules as $module) {
			$files[] = $module->js();
		}

		return $this->assets('js', $files);
	}
}