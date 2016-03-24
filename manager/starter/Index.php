<?php

namespace Manager\Starter;

use Arcane\Layers\Controller;
use Manager\Starter\Controllers\Content;

class Index extends Controller
{

	/**
	 * Endcut for rotines before processing a page
	 *	
	 * @return mixed 
	 */
	public function _before()
	{
        $this->router->post('/minha-casinha-vermelha');
	}

	/**
	 * Endcut for rotine on main process
	 * 
	 * @return mixed
	 */
	public function _process()
	{

	}

	/**
	 * Endcut for rotines before processing a page
	 *	
	 * @return mixed 
	 */
	public function _after()
	{

	}
}