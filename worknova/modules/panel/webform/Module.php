<?php

namespace Worknova\Panel\WebForm;

use Arcane\Layers\Controller;
use Worknova\Panel\WebForm\Controller\WebForm;

class Module extends Controller
{
	/**
	 * List all CSS files of the module
	 * 
	 * @return array
	 */
	public function css()
	{
		$files = ['bootstrap.min.css', 
				  'animate.min.css',
				  'custom.css'];

		$css = $this->assets('css', $files);

		$files = ['css/font-awesome.min.css'];

		$css = array_merge($css, $this->assets('fonts', $files));

		return $css;
	}

	/**
	 * List all JS files of the module
	 * 
	 * @return array
	 */
	public function js()
	{
		$files = [
				  'jquery.min.js',
				  'bootstrap.min.js',
				  'nicescroll/jquery.nicescroll.min.js',
				  'input_mask/jquery.inputmask.js',
				  'custom.js'
				 ];

		$js = $this->assets('js', $files);

		return $js;		  
	}

	/**
	 * Return the HTML content of module 
	 * 
	 * @return string
	 */
	public function getContent()
	{
		if (isset($_SESSION['user'])) {
			return $this->page('login');
		}

		$body   = $this->getBody();
		$menu   = $this->getMenu();
		$header = $this->getHeader();

		$placeholders = ['content' => $body,  
					     'menu'    => $menu, 	
					     'header'  => $header];

		$view = $this->view('layout');

		return $view->render($placeholders);
	} 

	/**
	 * Render the side menu bar
	 */
	public function getMenu()
	{
		$view = $this->view('menu');

		$modules = $this->module('Panel\*');

		$item = [];

		foreach ($modules as $module) {
			if (method_exists($module, 'menu')) {
				$menu = $module->menu();

				foreach ($menu as $key => $value) {
					$item['menu'][] = ['key' => $key, 'value' => $value];
				}
			}
		}

		return $view->render($item);
	}

	/**
	 * Render the header panel
	 * 
	 * @return string
	 */
	public function getHeader()
	{
		$view = $this->view('header');

		return $view->render();
	}

	/**
	 * Render the header panel
	 * 
	 * @return string
	 */
	public function getBody()
	{
		return $this->module()->getContent();
	}

	/**
	 * Render a single page 
	 * 
	 * @param  string $page 
	 * @return html       
	 */
	private function page(string $page)
	{
		$view = $this->view($page);

		return $view->render();		
	}
}