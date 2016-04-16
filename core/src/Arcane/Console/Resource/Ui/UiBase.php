<?php

namespace Arcane\Console\Resource\Ui;

use Arcane\Layers\View as Template;
use Arcane\Console\Resource\Base;

class UiBase extends Base
{
	/**
	 * Set template dir for the Form 
	 */
	public function __construct()
	{
		$this->path  = $this->getTemplateDir() . DS . 'Views';
	}
}