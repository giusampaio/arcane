<?php

namespace Worknova\Site\Opportunity\Model;

use Arcane\Layers\Model;

class Opportunity extends Model
{
	protected $table = 'opportunity';

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
		return $this->schema->table('opportunity')
                            ->string('title')
                            ->int('type')
                            ->string('description')
                            ->datetime('dt_create')
                            ->datetime('dt_update')
                            ->bool('active')
                            ->bool('ban')
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