<?php

namespace Arcane\Console\Traits;

trait Handler 
{
	/**
	 * Create a new directory
	 * 
	 * @param  string $dir Path to the new directory
	 * @return boolean
	 */
	public function mkDir($dir)
	{
		return mkdir(strtolower($dir), 755, true);
	}

	/**
	 * Open template file and expand vars
	 * 
	 * @param  string $file Full path to template file
	 * @param  array  $vars List of placeholders
	 * @return mixed 
	 */
	public function fopenReplace($file, $vars)
	{
		$content = fopen($file, 'r');
		$code    = fread($content, filesize($file));

		foreach($vars as $k => $v) {
			$code = str_replace('{{'.$k.'}}', $v, $code);
		}

		fclose($content);

		return $code;
	}

	/**
	 * Create new file
	 * 
	 * @param  string $file    Full path to new file
	 * @param  string $string  Content of new file
	 * @return boolean
	 */
	public function fopenWrite($file, $string)
	{
		if ( ! $handle = fopen($file, 'w') ) {
			throw new \Exception("Fail to writing in ".$file , 1);			
		} 

		return fwrite($handle, $string);
	}
}