<?php

namespace Arcane\Console\Resource;

use Arcane\Console\Resource\Base;

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

	public function layout()
	{
		$path = $this->getTemplateDir() . DS . 'Views';
		$file = $path . DS . 'Layout.tpl';

		$newPath = ROOT_PATH . DS . strtolower($this->project) . DS . 'starter' . DS . 'view';
		$newFile = $newPath . DS . 'layout.tpl';

		return copy($file, $newFile);
	}
}