<?php

namespace Arcane\Console\Resource;

use Arcane\Console\Resource\Base;
use Arcane\Console\Resource\Controller;

class Project extends Base
{
	/**
	 * Invoke a new project
	 * 
	 * @return boolean
	 */
	public function summon()
	{
		if ($this->hasProject($this->project)) {
			throw new \Exception("There's a project with that name.", 1);
		}

		$this->generateDirs();

		$this->generateConfigJson();

		$this->generateControllers();

		$this->generateView();
	}

	/**
	 * Generate all controller to the starter module
	 * 
	 * @return boolean
	 */
	public function generateControllers()
	{
		$controller = new Controller();

		$args = ['type' => 'index'];

		$controller->setProject($this->project)
				   ->setVendor($this->vendor)
				   ->setModule($this->module)
				   ->setArgs($args)
				   ->summon();

		$args = ['type' => 'service'];

		return $controller->setArgs($args)->summon();
	}

	/**
	 * 
	 * @return boolean
	 */
	public function generateView()
	{
		$view = new View();

		return $view->setProject($this->project)
					->summon();
	}

	/**
	 * Generate directory project
	 * 
	 * @return mixed
	 */
	public function generateDirs()
	{
		$dirs = ['assets','controller','view','model'];
		$base = $this->project . DS . 'starter';

		foreach ($dirs as $dir) {
			$this->mkDir($base . DS . $dir);
		}

		$base = $this->project . DS . 'modules';

		$this->mkDir($base);
	}

	/**
	 * Generate config.json
	 * 
	 * @return mixed
	 */
	public function generateConfigJson()
	{
		$path = $this->setProject($this->project)
					 ->getTemplateDir();

		$file =  $path . DS . 'Config' . DS . 'config.json';

		$newFile = ROOT_PATH . DS . strtolower($this->project . DS . 'starter' . DS . 'config.json');

		return copy($file, $newFile);
	}

	/**
	 * Check if project exists
	 * 
	 * @param  string  $project Name project case insentive
	 * @return boolean          
	 */
	public function hasProject($project)
	{
		return (is_dir(strtolower($project)));
	}
}