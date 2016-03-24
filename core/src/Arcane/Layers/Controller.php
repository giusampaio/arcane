<?php 

namespace Arcane\Layers;

//use Aura\Router\RouterContainer;

class Controller
{
	use \Arcane\Traits\Event;
	use \Arcane\Traits\Debug;

	protected $router = new RouterContainer();

	public function __call($method, $args)
	{
		$this->listen($method, $args);
	}
}