<?php

namespace Worknova\Panel\Address\Model;

use Arcane\Layers\Model;

class Address extends Model
{
	protected $table = 'address';

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
		return $this->schema->table('address')
                            ->pk('id')
                            ->string('address')
                            ->string('city')
                            ->string('state')
                            ->string('neighborhood')
                            ->string('postalcode')
                            ->float('longitude')
                            ->float('latitude')
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