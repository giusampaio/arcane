<?php

namespace Arcane\Console\Resource;

class Base 
{
	use \Arcane\Traits\Debug;
	use \Arcane\Console\Traits\Handler;

	/**
	 * Arguments passed to entity
	 * @var array
	 */
	protected $args;

	/**
	 * Vendor's name
	 * @var string
	 */
	protected $vendor;

	/**
	 * Module's Name
	 * @var string
	 */
	protected $module;
	
	/**
	 * Project's name
	 */
	protected $project;


	protected $templateDir = ARCANE_PATH . DS . 'Console' . DS . 'Templates';

	/**
	 * Set project name
	 * @param [type] $name [description]
	 */
	public function setProject($name)
	{
		$this->project = $name;

		return $this;
	}

	/**
	 * Set project name
	 * @param [type] $name [description]
	 */
	public function setModule($name)
	{
		$this->module = $name;

		return $this;
	}

	/**
	 * Set project name
	 * @param [type] $name [description]
	 */
	public function setVendor($name)
	{
		$this->vendor = $name;

		return $this;
	}

	/**
	 * Set project name
	 * @param [type] $name [description]
	 */
	public function setArgs($fields)
	{
		$this->args = $fields;

		return $this;
	}

	/**
	 * 
	 */
	protected function getTemplateDir()
	{
		return $this->templateDir;
	}
}