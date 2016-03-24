<?php

namespace Arcane\Layers;

use Arcane\Model\Schema;
use Arcane\Model\Database;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
	/**
	 * 
	 * @var \Arcane\Model\Database
	 */
	protected $db;

	/**
	 * 
	 * @var \Arcane\Model\Schema
	 */
	protected $schema;

	/**
	 * 
	 */
	public function __construct()
	{
		$this->db = new Database();
		$this->db->connect();
		$this->schema = new Schema();
		$this->schema->setConnection($this->db);
	}

	/**
	 * @return [type]
	 */
	public function connect()
	{

	}

}