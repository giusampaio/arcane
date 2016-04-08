<?php 

namespace Arcane\Layers;

use Arcane\Layers\View;
use Arcane\Http\Request;

class Controller
{
	use \Arcane\Traits\Event;
	use \Arcane\Traits\Debug;

	protected $router;

	protected $assetsDir;

	/**
	 * Check function endcuts
	 * 
	 * @param  string $method 
	 * @param  string $args   
	 * @return mixed
	 */
	public function __call($method, $args)
	{
		// Call method for events trait 	
		return $this->listen($method, $args);
	}

	/**
	 * Get base dir from controller
	 * 
	 * @return string
	 */
	protected function relativeDir()
	{
		// Get who invoke this function
		$class  = get_class($this);
		$pieces = explode('\\', $class);

		$dir = strtolower(implode('/', $pieces));

		return dirname($dir) . DS;
	}

	/**
	 * Get base dir from controller
	 * 
	 * @return string
	 */
	protected function absoluteDir()
	{
		// Get who invoke this function
		$class  = get_class($this);
		$pieces = explode('\\', $class);

		$reflector = new \ReflectionClass($class);
		$dir      = $reflector->getFileName();
		
		return dirname($dir) . DS;
	}

	/**
	 * Execute actions by function name on controller
	 * 
	 * @return mixed
	 */
	protected function _actions()
	{
		$req = new Request();

		$action = $req->action();

		if ($action == null) return false;

		if (! is_object($this)) return false;

		if (! method_exists($this, $action)) return false;

		return call_user_func_array([$this, $action], []);	
	}

	/**
	 * Get a instance of view with template and file setted
	 * 
	 * @return View
	 */
	public function view($tpl)
	{
		$path = $this->absoluteDir() .'view';

		// Get a view layer
		$view = new View();

		// Set path and return Mustache object
		return $view->path($path)->get($tpl);
	}

	/**
	 * Set assets path controller
	 * 
	 * @return this
	 */
	public function assets()
	{
		$this->assetsDir = $this->relativeDir() . 'assets';
		
		return $this;
	}

	/**
	 * Generate paths to create css
	 * 
	 * @param  array $files Files CSS
	 * @return array       
	 */
	public function css($files)
	{
		$css = [];

		foreach ($files as $file) {
			$path = str_replace('\\', '/', $this->assetsDir);
			$css[] =  $path .'/css' . $file;
		}	

		return $css;
	}

	/**
	 * Generate paths to create css
	 * 
	 * @param  array $files Files CSS
	 * @return array       
	 */
	public function js($files)
	{
		$js = [];

		foreach ($files as $file) {
			$path = str_replace('\\', '/', $this->assetsDir);
			$js[] =  $path .'/js' . $file;
		}	

		return $js;
	}


	/**
	 * Get a module object 
	 * 
	 * @param  
	 * @return 
	 */
	public function module($module) 
	{
		$request = new Request();	
		$project = ucfirst($request->project());

		$pieces = explode('\\', $module);
		$class  = $pieces[1];

		$namespace = $project .'\\'. $pieces[0] .'\\'. $class .'\\'. $class;

		return new $namespace(); 
	}
}