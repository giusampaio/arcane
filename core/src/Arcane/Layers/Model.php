<?php

namespace Arcane\Layers;

use Arcane\Database\Schema;
use Arcane\Database\Database;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
	use \Arcane\Traits\Debug;

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
	 * @var boolean
	 */
	public $timestamps  = false;

	/**
	 * 
	 */
	public function __construct()
	{
		$this->connectDatabase();

		$this->schema = new Schema();
		
		$this->schema->setConnection($this->db);
	}

	/**
	 * Set database connection
	 * 
	 * @return [type]
	 */
	public function connectDatabase()
	{
		if ( ! defined('CONFIG') )  {
			$err = "Configuration not found. Check if config.json file exists in starter dir.";
			throw new \Exception($err, 1);
		}

		$config = json_decode(CONFIG);

		if (! isset($config->database)) {
			$err = "Database sector not found in config.json";
			throw new \Exception($err, 1);
		}

		$driver = (array) $config->database;
 		
		$this->db = new Database();
		$this->db->connect($driver);
	}

}