<?php

namespace Arcane\Http;

class Request
{
	use \Arcane\Traits\Debug;

	/**
	 * 
	 */
	public function __construct()
	{
		$this->segment = $this->getSegmentIndex();
	}

	/**
	 * Parse URL and try get the current project
	 * 
	 * @return string
	 */
	public function project()
	{
		return $this->parseUrl('project', $this->segment);
	}

	/**
	 * Parse URL and try get the current module
	 * 
	 * @return string
	 */
	public function vendor()
	{
		return $this->parseUrl('vendor', $this->segment + 1);
	}

	/**
	 * Parse URL and try get the current module
	 * 
	 * @return string
	 */
	public function module()
	{
		return $this->parseUrl('module',  $this->segment + 2);
	}

	/**
	 * Parse URL and try get the current module
	 * 
	 * @return string
	 */
	public function action()
	{
		try {
			return $this->parseUrl('action', $this->segment + 3);
		} catch (\Exception $e) {
			return 'index';
		}
	}

	/**
	 * Parse some part of URL and return to client
	 * @param  string  $item  Item name requested
	 * @param  integer $index Position in array separated by slash
	 * @return string
	 */
	protected function parseUrl($item, $index)
	{
		if (isset($_GET[$item])) return $_GET[$item];

		$index++;

		$uri = $_SERVER['REQUEST_URI']; 	

		$pieces = explode('/', $uri);

		if (isset($pieces[$index])) {
			return $pieces[$index];
		}

		$errExplain = 'Check yout URL and yours configuration project.';

		throw new \Exception(ucfirst($item)." not found. $errExplain", 1);
	}

	/**
	 * Used to identify subdirectory in document root
	 */
	protected function getSegmentIndex()
	{
		$script = $_SERVER['SCRIPT_NAME'];

		$pieces = explode('/', $script);

		unset($pieces[0]);

		$index = array_search('public', $pieces) - 1;

		return $index;
	}	

}