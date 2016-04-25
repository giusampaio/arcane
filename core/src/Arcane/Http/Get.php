<?php

namespace Arcane\Http;

class Get
{
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
	public function item($index)
	{
		$item = $this->data[$index] ?? null;

		return $item;
	}
}