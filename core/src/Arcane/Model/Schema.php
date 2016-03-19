<?php

namespace Arcane\Model;

use Arcane\Model\Database;

class Schema 
{
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
	private $engine;

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
	public function add()
	{
		$headerSQL = 'ALTER TABLE '. $this->table ;
		$fieldSQL  = '';

		foreach($this->fields as $type => $fields) {
			foreach ($fields as $i => $field) {
				foreach ($field as $name) {
					$type = $this->getAliasField($type);
					$fieldSQL .= (strlen($fieldSQL)) ? ', ': '';
					$fieldSQL .= sprintf(' ADD COLUMN %s %s', $name, $type);
				}
			}
		}

		$sql = $headerSQL . $fieldSQL;

		return $sql;
	}

	/*
		Get field name by alias
	*/
	public function getAliasField($alias)
	{
		$list['string'] = 'varchar';

		return (isset($list[$alias]) ) ? $list[$alias] : $alias;
	}

	/*

	*/
	public function save()
	{
		$sql = ($this->hasTable($this->table)) ? $this->add() : $this->create();

		$this->db->exec($sql);
	}


	/*
		
	*/
	public function hasTable($table)
	{
		$search = 'SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME =:table';
		$values	= [':table' => $table];

		$ret = $this->db->select($search, $values);
		
		return empty($ret) ? false : true;
	}


	/*
		
	*/
	public function hasField()
	{
		return true;
	}
}
