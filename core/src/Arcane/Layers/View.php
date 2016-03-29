<?php

namespace Arcane\Layers;

use Mustache\Mustache_Autoloader;

class View 
{	

	/**
	 * Set path to template dirs
	 * @param  string $path [description]
	 * @return [type]       [description]
	 */
	public function path($path)
	{
		$this->path = strtolower($path);

		return $this;
	}

	/**
	 * [get description]
	 * @param  [type] $view [description]
	 * @return [type]       [description]
	 */
	public function get($view)
	{	
		\Mustache_Autoloader::register();
		
		$options = ['extension' => 'tpl']; 

		$loader = new \Mustache_Loader_FilesystemLoader($this->path, $options);

		$config = ['loader' => $loader];

		$tpl = new \Mustache_Engine($config);

		return $tpl->loadTemplate($view);
	}	


	/*
		Consulta o histórico de classes executadas e retorna o caminho para view 
	*/
	private function getViewPath()
	{
		$history  = debug_backtrace();

		$file = explode(DS, $history[1]['file']);
		
		array_pop($file);

		$path = implode(DS, $file);

		$path = str_replace('controllers', '', $path) . DS . 'views';
	
		return $path;	
	}
}