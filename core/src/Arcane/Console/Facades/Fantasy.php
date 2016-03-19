<?php

namespace Arcane\Console\Facades;

use Arcane\Console\View;
use Arcane\Console\Model;
use Arcane\Console\Module;
use Arcane\Console\Migrate;
use Arcane\Console\Console;
use Arcane\Console\Project;
use Arcane\Console\Controller;
use Arcane\Console\Facades\Terminal;


class Fantasy extends Terminal
{
	/*
		Execute validation and settings from real terminal
	 */	
	public function __construct()
	{
		parent::__construct();
	}
	

	/*
		
	 */
	public function summon($entity, $params)
	{
		if ($params==null) {
			$this->notFound('params');
			return null;
		}

		switch ($entity) {
			case 'project':		
				return Project::init($params);
				break;
			
			case 'model':		
				return Model::init($params);
				break;	

			case 'module':
				$module = new Module();		
				return $module->init($params);
				break;		

			case 'controller':
				$controller = new Controller();		
				return $controller->init($params);
				break;	

			case 'view':
				$view = new View();		
				return $view->init($params);
				break;	

			case 'migrate':
				return $this->migrate($entity, $params);
				break;	
				
			default:
				return 'Entity '.$entity.' not found';
				break;
		}
	}

	/*

	 */
	public function migrate($entity, $params)
	{
		if ( ! strpos($params, '.') ) {
			$path    = $params . DS . 'starter' . DS . 'models';
			$project = $params;
		} else {
			$pieces = split('.', $params);
			$path    = $pieces[0] . DS . 'modules' . DS . $pieces[1]; 
			$project = $pieces[0];
		} 		

		$files = scandir($path);

		unset($files[0]);
		unset($files[1]);

		$config = strtolower($project .DS . 'starter' . DS . 'config.php');

		if ( is_file($config) ) {
			define('CONFIG_FILE', realpath($config));
		}

		foreach ($files as $file) {

			include_once $path . DS . $file;

			$class = 'blog\\Starter\\Models\\' . str_replace('.php', '', $file);

			if ( ! class_exists($class) ) continue;

			$obj = new $class();

			if ( ! method_exists($obj, 'up') ) continue;

			$ret = call_user_func_array([$obj, 'up'], []);
		}

		return true;
	}

	/*

	*/
	public function help()
	{

		$header = '+==================== *** WELCOME TO ARCANCE *** ====================+' . PHP_EOL .
			  	  '|____________________________________________________________________|' . PHP_EOL .
			  	  '|                                                                    |' . PHP_EOL .
			  	  '| "We strongly believe that all programmers are mages and must have  |' . PHP_EOL . 
			  	  '|  arcane powers..."                                                 |' . PHP_EOL .
			  	  '|                                                                    |' . PHP_EOL .
			  	  '+====================================================================+' . PHP_EOL .
			  	  '|  version: 1.0. Fantasy Edition(C)                                  |' . PHP_EOL .
			  	  '+====================================================================+' . PHP_EOL ;

		$header = $this->color->paint($header, 'cyan');	  	  

		echo  PHP_EOL . $header . PHP_EOL . 
			  'Now , I\'ll guide you in this scroll:' . PHP_EOL . PHP_EOL .
			  'usage: arcane '.
			   $this->color->paint('<command>', 'light_green') . 
			   ':'. 
			   $this->color->paint('<entity>', 'light_blue') . 
			   $this->color->paint(' <args>.<args>.<args>...', 'yellow') . 
			   PHP_EOL . PHP_EOL .
			  'List of commands:' . PHP_EOL .
			   $this->color->paint('summon', 'light_green')   . 
			   '          Create a determined entity on your project'. PHP_EOL . PHP_EOL . 
			  'List of entitys:' . PHP_EOL .
			   $this->color->paint('project', 'light_blue')   . 
			   '         Responsable for all project'. PHP_EOL .
			   $this->color->paint('module ', 'light_blue')   . 
			   '         Responsable for a specify module in specify project'. PHP_EOL . 
			   $this->color->paint('model  ', 'light_blue')   .  
			   '         Responsable for a model in module or starter'. PHP_EOL . 
			   $this->color->paint('controller','light_blue') .  
			   '      Responsable for a controller in module or starter'. PHP_EOL . 
			   $this->color->paint('view', 'light_blue')      .  
			   '            Responsable for a view in module or starter' . PHP_EOL;
	}

}