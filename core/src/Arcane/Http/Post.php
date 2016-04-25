<?php

namespace Arcane\Http;

class Post
{
	use \Arcane\Traits\Debug;

	public function __construct()
	{
		$this->data = $_POST;
	}


	public function exists()
	{
		if (empty($this->data)) {
			return false;
		}

		return true;
	}

	/**
	 * Return a item catched from the post
	 * 
	 * @param  string|int $index 
	 * @return mixed
	 */
	public function item($index)
	{
		$item = $this->data[$index] ?? null;

		return $item; 
	}
}