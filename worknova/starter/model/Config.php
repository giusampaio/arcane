<?php

namespace Worknova\Starter\Model;

use Arcane\Layers\Model;

class Config extends Model
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
		return $this->schema->table('config')
							->save();
	}

	/**
	 * Instructions executed by disable
	 * @return bool
	 */
	public function down()
	{
		
	}
}