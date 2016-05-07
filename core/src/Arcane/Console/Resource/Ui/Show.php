<?php

namespace Arcane\Console\Resource\Ui;

use Arcane\Console\Resource\Base;
use Arcane\Layers\View as Template;
use Arcane\Console\Resource\Ui\Table;

class Show extends UiBase
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
	 * Set template dir for the Show 
	 */
	public function __construct(string $project, string $vendor, string $module)
	{
		$this->project = $project;
		$this->vendor  = $vendor;
		$this->module  = $module;

		parent::__construct();
	}

	/**
	 * Show 
	 * 
	 * @return boolean
	 */
	public function get(array $fields)
	{
		$view = new Template();

		$tpl = $view->path($this->path)->get('Admin/Show');


		$create = $this->url('create');

		$title    = 'New '. $this->module;
		$subtitle = 'List  '. $this->module;

		$obj = ['title'    	  => $title,
				'subtitle' 	  => $subtitle,
				'group_field' => $this->group()
			   ];


		return $tpl->render($obj);
	}

	public function group()
	{
		$view = new Template();
		
		$grp = $view->path($this->path)->get('Admin/GroupField');

		$obj = ['attr_begin' => '{{#attr}}',
				'attr_close' => '{{/attr}}',
				'key'		 => '{{key}}',
				'value'		 => '{{value}}'];
				
		return $grp->render($obj);
	}

	/**
	 * Return the url to route for a action
	 * #WORKARROUND Colocar outros DocumentRoots aqui
	 * 
	 * @param  string $action 
	 */
	public function url(string $action)
	{
		$dir = getcwd();

		$documentRoot = 'C:\xampp\htdocs\\';

		$subdir = str_replace($documentRoot, '', $dir);

		$base = $this->project . '/' . $this->vendor . '/' . $this->module;

		$url = strtolower('/' . $subdir . '/' . $base . '/' . $action);

		return $url;
	}
}

