<?php

namespace {{projectName}}\Starter;

use Arcane\View\Template;
use {{projectName}}\Starter\Controllers\Content;

class Index
{

	/*
		Rotines before processing a page
	*/
	public function before()
	{

	}

	/*

	*/	
	public function process()
	{
		$view = Template::get('theme\index');

		$content = new Content();

		echo $view->render($content);
	}

	/*
		Rotines after processing a page
	*/
	public function after()
	{

	}
}