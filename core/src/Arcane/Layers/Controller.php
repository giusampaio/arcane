<?php 

namespace Arcane\Layers;

use Arcane\Http\Get;
use Arcane\Http\Post;
use Arcane\Http\Router;
use Arcane\Layers\View;
use Arcane\Http\Request;

class Controller
{
	use \Arcane\Traits\Event;
	use \Arcane\Traits\Debug;
	use \Arcane\Traits\Resource;
	use \Arcane\Traits\Directory;

	protected static $get;

	protected static $post;

	protected static $router;

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
	public function view($tpl = null)
	{
		// 	
		if (! isset($tpl) || $tpl == null) {
			return false; 
		}

		$path = $this->absoluteDir() .'view';

		// Get a view layer
		$view = new View();

		// Set path and return Mustache object
		return $view->path($path)->get($tpl);
	}

	/**
	 * Generate paths to create css
	 * 
	 * @param  array $files Files CSS
	 * @return array       
	 */
	public function assets(string $type, array $files)
	{
		$this->assetsDir = $this->relativeDir() . 'assets';

		foreach ($files as $file) {
			
			$path = str_replace('\\', '/', $this->assetsDir);

			if (is_array($file)) continue;

			$files[] =  $path . '/'. $type . $file;
		}	

		return $files;
	}

	/**
	 * Get a module object 
	 * 
	 * @param  
	 * @return 
	 */
	public function module($module = null) 
	{
		if ($module == '*') {
			return $this->allModules();

		} elseif ($module != null) {
			return $this->singleModule($module);
		
		} else {
			return $this->currentModule();
		}
	}

	/**
	 * Post
	 * 
	 * @return Post Object
	 */
	public function post()
	{
		if (!isset(self::$post)) {
			self::$post = new Post();
		}	

		return self::$post;
	}

	/**
	 * get
	 * 
	 * @return get Object
	 */
	public function get()
	{
		if (!isset(self::$get)) {
			self::$get = new get();
		}	

		return self::$get;
	}

	/**
	 * Router
	 * 
	 * @return Router
	 */
	public function router()
	{
		if (!isset(self::$router)) {
			self::$router = new Router();
		}	

		return self::$router;	
	}
}