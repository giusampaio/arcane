<?php

namespace Arcane\Console\Resource\Ui;

use Arcane\Console\Resource\Base;
use Arcane\Layers\View as Template;
use Arcane\Console\Resource\Ui\Table;

class Index extends UiBase
{
	use \Arcane\Traits\Directory;

	/**
	 * Set template dir for the Index 
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Index 
	 * 
	 * @return boolean
	 */
	public function get(string $module, array $fields)
	{
		$view = new Template();

		$tpl = $view->path($this->path)->get('Admin/Index');

		$this->module = $module;

		$title    = 'New '. $module;
		$subtitle = 'List  '. $module;
		$fields   = $this->getTable($module, $fields);

		$obj = ['title'    => $title,
				'subtitle' => $subtitle,
				'table'    => $fields, 
			   	'options'  => true,
			   	'search'   => true];

		return $tpl->render($obj);
	}

	/**
	 * Get a element UI to insert on the form
	 * 
	 * @param  string $input 
	 * @param  string $name  
	 * @return mixed
	 */
	public function getTable($module, $fields)
	{
		$table = new Table();

		return $table->get($module, $fields);
	}
}

