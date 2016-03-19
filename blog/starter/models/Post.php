<?php

namespace Blog\Starter\Models;

use Arcane\Model\Model;

class Post extends Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function up()
	{
			$this->schema->table('loxo')
				  ->int('id')
				  ->varchar('nome')
				  ->text('descricao')
				  ->datetime('dt_created')
				  ->engine('InnoDB')
				  ->save();


	}

	public function down()
	{

	}
}