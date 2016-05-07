<?php

namespace Arcane\Http;

class Get
{
	use \Arcane\Traits\Debug;

	/**
	 * 
	 */
	public function __construct()
	{
		$this->data = $_REQUEST;
	}

	/**
	 * 
	 * @param  [type] $index [description]
	 * @return [type]        [description]
	 */
	public function segment($index)
	{
		$args =  explode('/', $this->data['q']);

		return (isset($args[$index])) ? $args[$index] : null;
	}
}