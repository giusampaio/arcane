<?php

namespace Arcane\Console\Resource\Ui;

use Arcane\Layers\View as Template;
use Arcane\Console\Resource\Base;

class Form extends Base
{
	use \Arcane\Traits\Directory;

	/**
	 * Set template dir for the Form 
	 */
	public function __construct()
	{
		$this->path  = $this->getTemplateDir() . DS . 'Views';
	}

	/**
	 * Form 
	 * 
	 * @return boolean
	 */
	public function get(string $module, array $fields)
	{
		$view = new Template();

		$tpl = $view->path($this->path)->get('Admin/Form');

		$this->module = $module;

		$title    = 'New '. $module;
		$subtitle = 'Create or edit a '. $module;
		$fields   = $this->getFields($fields);

		$obj = ['title'    => $title,
				'subtitle' => $subtitle,
				'fields'   => $fields, 
			   	'options'  => true];

		return $tpl->render($obj);
	}

	/**
	 * Parse fields given and return your html 
	 * 
	 * @param  array $fields 
	 * @return html
	 */
	public function getFields($fields)
	{
		$output = '';

		foreach ($fields as $field) {

			$pieces = explode('.', $field);

			if (! isset($pieces[2])) continue;

			$output .= $this->getElementUi($pieces[2], $pieces[0]);
		}

		return $output;
	}

	/**
	 * 
	 * @param  [type] $input [description]
	 * @param  [type] $name  [description]
	 * @return [type]        [description]
	 */
	public function getElementUi($input, $name)
	{
		$class = 'Arcane\\Console\\Resource\\Ui\\' . ucfirst($input);		

		$ui = new $class();

		return $ui->get($this->module, $name);
	}
}

