<?php

namespace Arcane\Http;

class Request
{
	use \Arcane\Traits\Debug;

	/**
	 * Parse URL and try get the current project
	 * 
	 * @return string
	 */
	public function project()
	{
		return $this->parseUrl('project', 0);
	}

	/**
	 * Parse URL and try get the current module
	 * 
	 * @return string
	 */
	public function vendor()
	{
		return $this->parseUrl('vendor', 1);
	}

	/**
	 * Parse URL and try get the current module
	 * 
	 * @return string
	 */
	public function module()
	{
		return $this->parseUrl('module', 2);
	}

	/**
	 * Parse some part of URL and return to client
	 * @param  string  $item  Item name requested
	 * @param  integer $index Position in array separated by slash
	 * @return string
	 */
	protected function parseUrl($item, $index)
	{
		if (isset($_GET[$item])) {
			return $_GET[$item];
		}

		$index++;

		$uri = $_SERVER['REQUEST_URI']; 	

		$pieces = explode('/', $uri);

		if (isset($pieces[$index])) {
			return $pieces[$index];
		}

		$errExplain = 'Check yout URL and yours configuration project.';

		throw new \Exception(ucfirst($item)." not found. $errExplain", 1);
	}

}