<?php 

namespace Arcane\Controller;


class Controller
{
	use \Arcane\Traits\Event;
	use \Arcane\Traits\Debug;

	public function __call($method, $args)
	{
		$this->listen($method, $args);
	}
}