<?php

namespace Arcane\Console\Traits;

trait Message 
{
	/**
	 * [error description]
	 * @param  [type] $error [description]
	 * @return [type]        [description]
	 */
	private function error($msg)
	{
		echo $msg;
	}
}