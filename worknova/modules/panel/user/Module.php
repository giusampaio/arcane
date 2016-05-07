<?php

namespace Worknova\Panel\User;

use Arcane\Layers\Controller;
use Worknova\Panel\User\Controller\User;

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
		$files = ['form.js'];

		$js = $this->assets('js', $files);

		return $js;
	}

	/**
	 * Return the HTML content  of module 
	 * 
	 * @return string
	 */
	public function getContent()
	{
		$user = new User();

		return $user->actions();			
	} 

	/**
	 * 
	 */
	public function menu()
	{
		return ['Usuários' => '/arcane/worknova/panel/user/index'];
	}
}