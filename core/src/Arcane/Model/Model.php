<?php

namespace Arcane\Model;

use Arcane\Model\Schema;

class Model
{
	protected $schema;

	public function __construct()
	{
		$this->schema = new Schema();
	}
}