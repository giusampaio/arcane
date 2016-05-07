<?php

namespace Arcane\Console\Resource;

use Arcane\Console\Resource\Base;
use Arcane\Console\Resource\Project;
use Arcane\Console\Resource\Controller;

class Module extends Base
{

	/**
	 * Invoke a new project
	 * 
	 * @return boolean
	 */
	public function summon()
	{
		if ( ! isset($this->args['project']) ) {
			throw new \Exception("Project not defined.", 1);
		}

		$name = $this->args['project'][0];

		$project = new Project();

		if ( ! $project->exists($name) ) {
			throw new \Exception("Project don't exists.", 1);
		}

		$this->setProject($name);

		$this->generateDirs();

		$this->generateController();

		$this->generateModel();

		$this->generateViews();
	}

	/**
	 *	Create
	 * 
	 * @return [type] [description]
	 */
	public function generateDirs()
	{
		$base = $this->project . DS . 'modules' . DS; 
		$base = $base . $this->vendor . DS . $this->module;
		$dirs = ['assets','controller','view','model'];

		foreach ($dirs as $dir) {
			$this->mkDir($base . DS . $dir);
		}
	}

	/**
	 * Generate all controller to the starter module
	 * 
	 * @return boolean
	 */
	public function generateController()
	{
		$controller = new Controller();

		$up = ( isset($this->args['up']) ) ? $this->args['up'] : null;

		$args = ['type' => 'service', 'up' => $up];

		$controller->setProject($this->project)
				   	->setVendor($this->vendor)
				   	->setModule($this->module)
				   	->setObject($this->module)
				   	->setArgs($args)
				   	->summon();


		$args = ['type' => 'module'];

		return $controller->setArgs($args)->summon();
	}

	/**
	 * Generate all controller to the starter module
	 * 
	 * @return boolean
	 */
	public function generateModel()
	{
		$model = new Model();

		return $model->setProject($this->project)
				   	 ->setVendor($this->vendor)
				   	 ->setModule($this->module)
				   	 ->setObject($this->module)
				   	 ->setArgs($this->args)
				   	 ->summon();
	}

	/**
	 * Generate all views to the module
	 * 
	 * @return boolean
	 */
	public function generateViews()
	{
		$view = new View();

		return $view->setProject($this->project)
				   	 ->setVendor($this->vendor)
				   	 ->setModule($this->module)
				   	 ->setObject($this->module)
				   	 ->setArgs($this->args)
				   	 ->form()
				   	 ->index()
				   	 ->show();	
	}
}