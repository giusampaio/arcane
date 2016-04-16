<?php

namespace Arcane\Console\Resource;

use Arcane\Console\Resource\Base;
use Arcane\Layers\View as Template;
use Arcane\Console\Resource\Ui\Form;

class View extends Base
{
	/**
	 * Generate config.json
	 * 
	 * @return mixed
	 */
	public function summon()
	{
		$this->layout();	
	}

	/**
	 * Generate layout base to the starter
	 * 
	 * @return boolean
	 */
	public function layout()
	{
		$path = $this->getTemplateDir() . DS . 'Views';

		$file = $path . DS . 'Layout.tpl';

		$newPath = ROOT_PATH . DS . strtolower($this->project) . DS . 'starter' . DS . 'view';
		$newFile = $newPath . DS . 'layout.tpl';

		return copy($file, $newFile);
	}

	/**
	 * Form 
	 * 
	 * @return boolean
	 */
	public function form()
	{
		$form = new Form();

		echo $form->get($this->module, $this->args['up']);

		exit;
	}


	/**
	 * 
	 * 
	 * @return array
	 */
	public function getUp()
	{
		if (! isset($this->args['up'])) return null;

		$up = '';

		$vew = new Template();

		foreach ($this->args['up'] as $arg) {
			$up .= $this->getElementUi($arg);
		}
		
		return $up;
	}
}