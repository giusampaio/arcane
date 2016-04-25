<?php

namespace Arcane\Console\Resource\Ui;

use Arcane\Layers\View as Template;
use Arcane\Console\Resource\Ui\UiBase;

class Table extends UiBase
{
	/**
	 * Set template dir for the Form 
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

		$tpl = $view->path($this->path)->get('Admin/Table');

		$placeholders = $this->getPlaceholders($module, $fields);

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
				'rows' 	   	  => $rows];

		return $obj;
	}
}