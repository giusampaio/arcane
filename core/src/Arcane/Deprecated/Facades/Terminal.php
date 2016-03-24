<?php

namespace Arcane\Console\Facades;

use Arcane\Console\Color;

class Terminal
{
	protected $color;

	/*

	*/
	public function __construct()
	{
		$this->color = new Color();
	
		if (!defined('DS')) {
			define('DS', DIRECTORY_SEPARATOR);
		}
	}

	/*
		
	*/
	public function input($args)
	{
		if (! isset($args[1]) || $args[1] == 'help') {
			$this->help();
			return false;
		}

		@list($method, $entity) = explode(':', $args[1]);

		if (!method_exists($this, $method)) {
			$this->notFound('method', $method);
			return false;
		}

		if (!isset($entity)) {
			$this->notFound('entity', $method);
			return false;
		}

		$params = (isset($args[2])) ? $args[2] : null;

		$error = $this->$method($entity, $params);

		if ($error===true) {
			$this->confirm('Sucess');
			return true;
		}

		$this->error($error);

		return false;
	}

	/*

	 */
	public function error($msg)
	{
		$error = '[Arcane Advise] '. PHP_EOL;
		
		$help = PHP_EOL .'See help for more details' . PHP_EOL ;

		echo $this->color->paint($error, 'red') . PHP_EOL . $msg . PHP_EOL . $help;
	}

	/*

	 */
	public function confirm($msg)
	{
		$error = '[Arcane Confirm] '. PHP_EOL;
		
		echo $this->color->paint($error, 'cyan') . PHP_EOL . $msg. PHP_EOL;
	}

	/*

	 */
	public function notFound($type , $method = null)
	{
		if ($type == 'method') {
			$msg = 'Watch out, mage! your method <'. $method .'> not exist...'. PHP_EOL;
	
		} elseif ($type == 'params') {
			$msg = 'Watch out, mage! your must pass some args for your method...'. PHP_EOL;
		
		} else {
			$msg = 'Watch out, mage! your method <'. $method .'> don\'t  have entity...'. PHP_EOL;
		}

		$this->error($msg);

	}
}