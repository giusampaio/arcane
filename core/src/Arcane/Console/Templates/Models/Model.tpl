<?php

namespace {{namespace}};

use Arcane\Layer\Model;

class {{nameModel}} extends Model
{
	public function __construct()
	{
		$this->schema = new Schema();
	}

	/**
	 * Instructions executed by migrate
	 * @return bool
	 */
	public function up()
	{

	}

	/**
	 * Instructions executed by disable
	 * @return bool
	 */
	public function down()
	{

	}
}