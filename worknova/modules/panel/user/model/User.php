<?php

namespace Worknova\Panel\User\Model;

use Arcane\Layers\Model;

class User extends Model
{
	protected $table = 'user';

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 
	 * @return string
	 */
	public function address()
	{
		return $this->hasMany('Workova\Panel\Address\Model\Address', 'id', 'address_id');	
	}

	/**
	 * Instructions executed by migrate
	 * @return bool
	 */
	public function up()
	{
		return $this->schema->table('user')
                            ->pk('id')
                            ->int('accept')
                            ->string('firstname')
                            ->string('lastname')
                            ->string('password')
                            ->int('facebook_id')
                            ->datetime('dt_create')
                            ->datetime('dt_update')
                            ->datetime('dob')
                            ->int('address_id')
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