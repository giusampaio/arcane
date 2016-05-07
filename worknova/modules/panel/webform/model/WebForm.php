<?php

namespace Worknova\Panel\WebForm\Model;

use Arcane\Layers\Model;

class WebForm extends Model
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
		//return $this->schema->table('webform')
		//					->save();
	}

	/**
	 * Instructions executed by disable
	 * @return bool
	 */
	public function down()
	{
		
	}
}