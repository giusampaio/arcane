<?php

namespace Worknova\Starter;

use Arcane\Layers\Controller;
use Worknova\Starter\Controllers\Content;

class Index extends Controller
{
	/**
	 * View file from Worknova
	 * 
	 * @var string
	 */
	public $layout = 'layout';

	/**
	 * List with all modules installed on Worknova
	 * 
	 * @var array
	 */
	private $modules = [];

	/**
	 * 
	 */
	public function __construct()
	{
		$this->modules = $this->module('Panel\*');
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

		$css = $this->assets('css', $files);

		foreach ($this->modules as $module) {
			$css = array_merge($css, $module->css());
		}

		return $css;
	}

	/**
	 * Endcut for rotine on main process
	 * 
	 * @return mixed
	 */
	public function getContent()
	{
		$obj = $this->module('Panel\Webform');	

		return $obj->getContent();
	}

	/**
	 * Function to get all JS files on project
	 *	
	 * @return mixed 
	 */
	public function js()
	{
		$files = [];

		krsort($this->modules);

		foreach ($this->modules as $module) {
			if (! method_exists($module, 'js')) continue;
			$files = array_merge($files, $module->js());
		}

		return $files;
	}
}
