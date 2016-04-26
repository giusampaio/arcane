<?php

namespace Arcane\Database;

use Arcane\Database\Database;

class Schema 
{
	use \Arcane\Traits\Debug;

	private $dbname;

	/**
	 * Array fields 
	 * @var array
	 */
	private $fields;

	/**
	 * Table name
	 * @var string
	 */
	private $table;

	/**
	 * Engine 
	 * @var string
	 */
	private $engine = 'InnoDB';

	/**
	 * @param  [type]
	 * @param  mixed 
	 * @return self
	 */
	public function __call($type, $name)
	{
		if ($type == 'table' || $type=='engine') {
			$this->$type = $name[0];
			return $this;
		}

		if ($type=='varchar') {
			$type = 'varchar(50)';
		}

		$this->fields[$type][] = $name;
		return $this;
	}

	/**
	 * @param [type]
	 */
	public function setConnection($db)
	{
		$this->db = $db;
	}


	public function setDatabaseName($name)
	{
		$this->dbname = $name;
	}

	/**
	 * 
	 * @return [type]
	 */
	public function create()
	{
		$headerSQL = 'CREATE TABLE '. $this->table . '(';
		$footerSQL = ') Engine='. $this->engine;
		$fieldSQL  = '';

		foreach($this->fields as $type => $fields) {
			foreach ($fields as $i => $field) {
				foreach ($field as $name) {
					$type = $this->getAliasField($type); 
					$fieldSQL .= (strlen($fieldSQL)) ? ', ': '';
					$fieldSQL .= sprintf('%s %s', $name, $type);
				}
			}
		}

		$sql = $headerSQL . $fieldSQL . $footerSQL;

		return $sql;
	}


	/*

	*/
	public function alter()
	{
		$headerSQL = 'ALTER TABLE '. $this->table ;
		$fieldSQL  = '';

		foreach($this->fields as $type => $fields) {
			foreach ($fields as $i => $field) {
				foreach ($field as $name) {
					$type    = $this->getAliasField($type);
					
					// Not alter id collumn fot while...
					if ($name=='id') continue;

					if ($this->hasColumn($this->table, $name)) {
						$command = sprintf(' CHANGE COLUMN %s %s %s', $name, $name, $type);
					}  else {
						$command = sprintf(' ADD COLUMN %s %s', $name, $type);
					}
					
					$fieldSQL .= (strlen($fieldSQL)) ? ', ': '';
					$fieldSQL .= $command;
				}
			}
		}

		$sql = $headerSQL . $fieldSQL;

		return $sql;
	}

	/**
	 * List of alias to the collumn type
	 * 
	 * @param  [type]
	 * @return [type]
	 */
	public function getAliasField($alias)
	{
		$list['string'] = 'varchar(50)';
		$list['pk'] 	= 'int AUTO_INCREMENT PRIMARY KEY';

		return (isset($list[$alias])) ? $list[$alias] : $alias;
	}

	/*

	*/
	public function save()
	{
		$sql = ($this->hasTable($this->table)) ? $this->alter() : $this->create();

		return $this->db->exec($sql);
	}


	/*
		
	*/
	public function hasTable($table)
	{
		$search = 'SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME =:table AND TABLE_SCHEMA = :database';
		$values	= [':table' => $table, 
				   ':database' => $this->dbname];

		$ret = $this->db->select($search, $values);

		return empty($ret) ? false : true;
	}


	/*
		
	*/
	public function hasColumn($table, $column)
	{
		$search = 'SELECT * 
						FROM INFORMATION_SCHEMA.COLUMNS 
					WHERE 
					    TABLE_SCHEMA = :database AND 
						TABLE_NAME   = :table AND
						COLUMN_NAME  = :column';


		$values	= [':table'    => $table, 
				   ':column'   => $column,
				   ':database' => $this->dbname];

		$ret = $this->db->select($search, $values);
		
		return empty($ret) ? false : true;
	}
}
