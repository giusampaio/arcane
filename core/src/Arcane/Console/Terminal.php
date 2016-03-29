<?php

namespace Arcane\Console;

use Arcane\Autoload\Load;
use Arcane\Application\App;

class Terminal 
{
	use Traits\Message;

	/**
	 * Command require by console
	 * @var string
	 */
	private $command;

	/**
	 * Entity to handle command (e.g: Model, Controller)
	 * @var string
	 */
	private $entity;

	/**
	 * Arguments passed to entity
	 * @var array
	 */
	private $args;

	/**
	 * Vendor's name
	 * @var string
	 */
	private $vendor;

	/**
	 * Module's Name
	 * @var string
	 */
	private $module;
	
	/**
	 * Project's name
	 */
	private $project;

	/**
	 * Set einvoirement constants
	 */
	public function __construct()
	{
		$app = new App();
		$app->setConsts();
		Load::registerAutoload();
	}

	/**
	 * Console Main Process
	 * 
	 * @param  array $input [description]
	 * @return mixed        [description]
	 */
	public function execute($args)
	{
		if (count($args) < 2 ) {
			return $this->error('Command Not found');
		}

		if (! $this->parseCmd($args)) { 
			return $this->error('Command invalid');
		}
		
		if (! $this->parseName($args)) {
		 return $this->error('Name given invalid');
		}

		$entity = $this->callEntity();

		if ( $entity == false ) { 
			return $this->error('Entity not found');
		}

		if ( ! method_exists($entity, $this->command) ) {
			return $this->error('Command given invalid by entity');
		} 

		$entity->setProject($this->project)
			   ->setVendor($this->vendor)
			   ->setModule($this->module)
			   ->setArgs($this->args);

		try {
			
			call_user_func_array(array($entity, $this->command), array());
	
		} catch (\Exception $e) {

			$this->error($e->getMessage());	
		}
	}

	/**
	 * Parse command passed by console
	 * 
	 * @param  [type] $args [description]
	 * @return bool
	 */
	private function parseCmd($args)
	{	
		if (! isset($args[1]) && strpos($args[1],':')) return false; 

		$this->command = $args[1];

		$pieces = explode(':', $args[1]);

		$this->command = $pieces[0];
		$this->entity  = $pieces[1];
	
		return true;
	}

	/**
	 * [parseName description]
	 * @param  [array] $args [description]
	 * @return bool
	 */
	private function parseName($args)
	{
		if (! isset($args[2]) ) return false; 

		$name = $args[2];

		if ( strpos($name, '.') ) {
			return $this->parseNamespace($name);
		}

		$this->project = $name;

		return true;
	}

	/**
	 * [parseNamespace description]
	 * @param  [type] $namespace [description]
	 * @return [type]            [description]
	 */
	private function parseNamespace($namespace)
	{
		$pieces = explode('.', $name);
		$this->vendor = $pieces[0];
		$this->module =	$pieces[1];

		if ( isset($pieces[2]) ) {
			$this->object = $pieces[2];
		}

		return true;
	}

	/**
	 * [callEntity description]
	 * 
	 * @return [type] [description]
	 */
	public function callEntity()
	{
		$namespace = 'Arcane\\Console\\Resource\\';
		
		if (Load::is_arcane($namespace, $this->entity) == false) return false;

		return Load::getClass($namespace, $this->entity, null);;
	}
}