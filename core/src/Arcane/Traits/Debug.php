<?php

namespace Arcane\Traits;

trait Debug 
{

	/**
	 * [say description]
	 * @param  [type] $msg [description]
	 * @param  [type] $ip  [description]
	 */
	public function say($msg, $ip = null) {
		
		if ( $ip != null && $_SERVER['REMOTE_ADDR'] != $ip ) return false; 

		print('<pre>');
		$last = $this->getLastTrack();
		print($last .' said ');
		print_r($msg);
		print('</pre>');		
		die();
	}


	/**
	 * Pega o nome da classe e da função que executou a função de debug
	 * 
	 * @return [type] [description]
	 */
	private function getLastTrack()
	{
		$last_trace = debug_backtrace();

		if ( ! isset($last_trace[2]) ) {
			return 'Undefined::undefined';
		}

		$last_trace = $last_trace[2];

		return $last_trace['class'] . $last_trace['type'] . $last_trace['function'];
	}
}