<?php

namespace Arcane\Console\Resource\Ui;

use Arcane\Layers\View as Template;
use Arcane\Console\Resource\Base;

class UiBase extends Base
{
	/**
	 * CSS dependcies of the UI
	 * @var array
	 */
	private $css;

	/**
	 * JS dependcies of the UI
	 * @var array
	 */
	private $js;

	/**
	 * Set template dir for the Form 
	 */
	public function __construct()
	{
		$this->path  = $this->getTemplateDir() . DS . 'Views';
	}

	public function setCSS($css)
	{	
		$this->css[] = $css;
	}

	public function setJS($file)
	{
		$this->js[] = $file;
	}

	public function getCSS()
	{
		$this->css;
	}

	public function getJS()
	{
		$this->js;
	}
}