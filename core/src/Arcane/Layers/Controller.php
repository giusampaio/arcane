<?php 

namespace Arcane\Layers;

use Aura\Router\RouterContainer;
use Arcane\Autoload\Load;
use Arcane\Layers\View;

class Controller
{
	use \Arcane\Traits\Event;
	use \Arcane\Traits\Debug;

	protected $router;

	/**
	 * Check function endcuts
	 * 
	 * @param  string $method [description]
	 * @param  string $args   [description]
	 */
	public function __call($method, $args)
	{
		// Call method for events trait 	
		return $this->listen($method, $args);
	}

	/**
	 * [resources description]
	 * @param  [type] $obj [description]
	 * @return [type]      [description]
	 */
	protected function _resources($obj)
	{
		$action = Load::getAction();

		if ($action == null) return false;

		if (! is_object($obj)) return false;

		if (! method_exists($obj, $action)) return false;

		return call_user_func_array([$obj, $action], []);	
	}

	/**
	 * 
	 * @return 
	 */
	public function view($tpl)
	{
		// Template path of controller 
		$path = dirname(get_class($this)) . DS . 'view';

		// Get a view layer
		$view = new View();

		// Set path and return Mustache object
		return $view->path($path)->get($tpl);
	}
}