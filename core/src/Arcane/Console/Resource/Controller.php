<?php

namespace Arcane\Console\Resource;

use Arcane\Console\Resource\Base;

class Controller extends Base
{
	/**
	 * Invoke a new controller to the project or module
	 * 
	 * @return boolean
	 */
	public function summon()
	{
		$type = (isset($this->args['type'])) ? $this->args['type'] : null;

		switch ($type) {
			case 'controller':
				$this->controller();
				break;
			
			default:
				$this->index();
				break;
		}
	}

	/**
	 * Create a Index Controller 
	 * 
	 * @return mixed
	 */
	public function index()
	{
		$tpl  = $this->templateDir. DS .'Controllers'. DS .'Index.tpl';
		$vars = ['projectName' => $this->project];

		$content = $this->fopenReplace($tpl, $vars);
		$file = strtolower($this->project) . DS . 'starter' . DS . 'Index.php'; 

		$this->fopenWrite($file, $content);
	}

}
