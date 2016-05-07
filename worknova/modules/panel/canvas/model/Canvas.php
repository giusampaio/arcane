<?php

namespace Worknova\Panel\Canvas\Model;

use Arcane\Layers\Model;

class Canvas extends Model
{
	protected $table = 'canvas';

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
		return $this->schema->table('canvas')
                            ->pk('id')
                            ->string('teste')
                            ->string('description')
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