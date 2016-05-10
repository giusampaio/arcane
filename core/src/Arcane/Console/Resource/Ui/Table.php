<?php

namespace Arcane\Console\Resource\Ui;

use Arcane\Layers\View as Template;
use Arcane\Console\Resource\Ui\UiBase;

class Table extends UiBase
{
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

		$tpl = $view->path($this->path)->get('Admin/Table');

		$placeholders = $this->getPlaceholders($this->module, $fields);

		return $tpl->render($placeholders);
	}

	/**
	 * Parse fields given and return your html 
	 * 
	 * @param  array $fields 
	 * @return html
	 */
	public function getPlaceholders($module, $fields)
	{
		$collumns = '';
		$module   = strtolower($module);
		$rows     = '';

		foreach ($fields as $field) {

			$pieces = explode('.', $field);

			if (! isset($pieces[2])) continue;

			$collumns[] = $pieces[0];
			$rows[]		= '{{' . $pieces[0] .'}}';
		}

		$obj = ['collumns' 	  => $collumns,
				'module_init' => '{{#'. $module .'}}',
				'module_end'  => '{{/'. $module .'}}',
				'view'	  	  => $this->url('show/{{id}}'),
				'edit'		  => $this->url('edit/{{id}}'),
				'remove'	  => $this->url('remove/{{id}}'),
				'id'		  => '{{id}}',   
				'rows' 	   	  => $rows];

		return $obj;
	}
}