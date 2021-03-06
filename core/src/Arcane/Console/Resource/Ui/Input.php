<?php

namespace Arcane\Console\Resource\Ui;

use Arcane\Layers\View as Template;
use Arcane\Console\Resource\Ui\UiBase;

class Input extends UiBase
{
	/**
	 * Set template dir for the Form 
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Form 
	 * 
	 * @return boolean
	 */
	public function get(string $module, string $name)
	{
		$view = new Template();

		$tpl = $view->path($this->path)->get('Admin/Input');

		$obj = ['label' 	=> $name,
				'required'  => false, 
			   	'module'	=> $module,
			   	'value'		=> '{{'.strtolower($name) .'}}',
			   	'name'		=> strtolower($module) . "[$name]"];

		return $tpl->render($obj);
	}
}