<?php

namespace Arcane\View;

use Mustache\Mustache_Autoloader;

class Template 
{	
	/*
		Retorna o objeto
	*/
	public static function get($view)
	{	
		\Mustache_Autoloader::register();

		$path = self::getViewPath();
		
		$options = ['extension' => 'tpl']; 

		$loader = new \Mustache_Loader_FilesystemLoader($path, $options);

		$config = ['loader' => $loader];

		$tpl = new \Mustache_Engine($config);

		return $tpl->loadTemplate($view);
	}	


	/*
		Consulta o histórico de classes executadas e retorna o caminho para view 
	*/
	private static function getViewPath()
	{
		$history  = debug_backtrace();

		$file = explode(DS, $history[1]['file']);
		
		array_pop($file);

		$path = implode(DS, $file);

		$path = str_replace('controllers', '', $path) . DS . 'views';
	
		return $path;	
	}
}