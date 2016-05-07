<?php

namespace Arcane\Traits;

trait Directory 
{
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

		if (end($pieces) == 'Module') {
			$project = array_shift($pieces);
			$pieces  = array_merge([$project], ['modules'], $pieces);
		} 
			
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

		// Se é uma classe que fica dentro do diretório controller
		// Desça 2 niveis para encontrar a raiz do modulo  
		$level = (isset($pieces[4]) ) ? 2 : 1;

		$reflector = new \ReflectionClass($class);

		$dir = $reflector->getFileName();
		
		return dirname($dir, $level) . DS;
	}
}