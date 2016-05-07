<?php

namespace Worknova\Site\WebForm;

use Arcane\Layers\Controller;
use Worknova\Site\WebForm\Controller\WebForm;

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
		return null;
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

		$modules = $this->module('*');

		$item = [];

		foreach ($modules as $module) {
			if (method_exists($module, 'menu')) {
				$item['menu'] = $module->menu();
			}
		}

		return $view->render($item);
	}

	/**
	 * Render the header site
	 * 
	 * @return string
	 */
	public function getHeader()
	{
		$view = $this->view('header');

		return $view->render();
	}

	/**
	 * Render the header site
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