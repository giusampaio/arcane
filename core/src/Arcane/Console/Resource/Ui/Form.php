<?php

namespace Arcane\Console\Resource\Ui;

use Arcane\Layers\View as Template;
use Arcane\Console\Resource\Base;

class Form extends UiBase
{
	use \Arcane\Traits\Directory;

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
	 * Form 
	 * 
	 * @return boolean
	 */
	public function get(array $fields)
	{
		$view = new Template();

		$tpl = $view->path($this->path)->get('Admin/Form');

		$title    = 'New '. $this->module;
		$subtitle = 'Create or edit a '. $this->module;
		$fields   = $this->getFields($fields);

		$obj = ['title'    => $title,
				'subtitle' => $subtitle,
				'fields'   => $fields, 
				'back'	   => $this->url('index'),
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

