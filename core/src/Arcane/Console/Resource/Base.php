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

	/**
	 * Directory base for template files
	 * @var string
	 */
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
	 * Set project name
	 * @param [type] $name [description]
	 */
	public function setObject($fields)
	{
		$this->object = $fields;

		return $this;
	}

	/**
	 * 
	 */
	protected function getTemplateDir()
	{
		return $this->templateDir;
	}

	/**
	 * Call specie of entity
	 * @return void
	 */
	protected function call()
	{
		// check type of controller...
		$type = (isset($this->args['type'])) ? $this->args['type'] : null;

		// execute function by type...
		if (method_exists($this, $type)) {
			call_user_func_array([$this, $type], []);
		}
	}

	/**
	 * Return file name to project 
	 * 
	 * @return string
	 */
	public function getFileName($name, $type)
	{
		if (! isset($this->vendor) || $this->vendor == null) {

			$file = '%s'. DS .'starter'. DS . $type . DS .'%s.php'; 
			$file = sprintf($file, strtolower($this->project), ucfirst($name));
			
		} else {

			$dir = 'modules' . DS . $this->vendor . DS . $this->module;

			$file = '%s'. DS .'%s'. DS . '' . $type . DS .'%s.php'; 
			$file = sprintf($file, strtolower($this->project), strtolower($dir), ucfirst($name));
		}

		return $file;
	}

	
	/**
	 * Recover namespace for service controller
	 * 
	 * @return string
	 */
	public function getNamespace($type)
	{	
		$type = ucfirst($type);

		if (! isset($this->vendor) || $this->vendor == null) {
			$namespace = "$this->project\\Starter\\". $type;
		
		} else {
			$namespace = "$this->project\\$this->vendor\\$this->module\\". $type; 
		}

		return $namespace;
	}

	/**
	 * Get a template file in accord by type
	 * @return string
	 */
	public function getTemplateFile($type)
	{
		$type = ucfirst($type);

		// Path to find controller service template
		$tpl  = $this->templateDir. DS . $type . 's'. DS . $type . '.tpl';

		return $tpl;
	}
}