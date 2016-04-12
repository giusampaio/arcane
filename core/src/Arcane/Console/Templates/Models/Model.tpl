<?php

namespace {{namespace}};

use Arcane\Layer\Model;

class {{nameModel}} extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Instructions executed by migrate
	 * @return bool
	 */
	public function up()
	{
		return $this->schema->table('{{table}}'){{up}};
	}

	/**
	 * Instructions executed by disable
	 * @return bool
	 */
	public function down()
	{
		
	}
}