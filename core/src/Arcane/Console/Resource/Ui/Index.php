<?php

namespace Arcane\Console\Resource\Ui;

use Arcane\Console\Resource\Base;
use Arcane\Layers\View as Template;
use Arcane\Console\Resource\Ui\Table;

class Index extends UiBase
{
	use \Arcane\Traits\Directory;
	use \Arcane\Traits\Resource;

	/**
	 * Name of the project
	 * @var [type]
	 */
	protected $project;


	protected $vendor;

	/**
	 * Set template dir for the Index 
	 */
	public function __construct(string $project, string $vendor, string $module)
	{
		$this->project = $project;
		$this->vendor  = $vendor;
		$this->module  = $module;

		parent::__construct();
	}

	/**
	 * Index 
	 * 
	 * @return boolean
	 */
	public function get(array $fields)
	{
		$view = new Template();

		$tpl = $view->path($this->path)->get('Admin/Index');

		$create = $this->url('create');

		$title    = 'New '. $this->module;
		$subtitle = 'List  '. $this->module;
		$fields   = $this->getTable($this->module, $fields);

		$obj = ['title'    	 => $title,
				'subtitle' 	 => $subtitle,
				'module'   	 => $this->module,
				'url_create' => $create,
				'table'      => $fields, 
			   	'options'    => true,
			   	'search'     => true];

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
		$table = new Table($this->project, $this->vendor, $this->module);

		return $table->get($fields);
	}
}