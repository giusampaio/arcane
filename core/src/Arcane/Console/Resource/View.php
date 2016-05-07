<?php

namespace Arcane\Console\Resource;

use Arcane\Console\Resource\Base;
use Arcane\Layers\View as Template;
use Arcane\Console\Resource\Ui\Form;
use Arcane\Console\Resource\Ui\Index;
use Arcane\Console\Resource\Ui\Show;

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

		$content = $form->get($this->module, $this->args['up']);

		$file = $this->getFileName('form', 'view', 'tpl');

		$this->fopenWrite($file, $content);

		return $this;
	}


	/**
	 * Index
	 * 
	 * @return boolean
	 */
	public function index()
	{
		$index =  new Index($this->project, $this->vendor, $this->module);

		$content = $index->get($this->args['up']);

		$file = $this->getFileName('index', 'view', 'tpl');

		$this->fopenWrite($file, $content);

		return $this;
	}

	/**
	 * Show view 
	 * 
	 * @return string
	 */
	public function show()
	{
		$show =  new Show($this->project, $this->vendor, $this->module);

		$content = $show->get($this->args['up']);

		$file = $this->getFileName('show', 'view', 'tpl');

		$this->fopenWrite($file, $content);

		return $this;	
	}
}