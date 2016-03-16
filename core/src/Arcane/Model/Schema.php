<?php

namespace Arcane\Model;

class Schema 
{
	private $fields;
	private $table;
	private $engine;

	/*

	*/
	public function __call($type, $name)
	{
		if ($type == 'table' || $type=='engine') {
			$this->$type = $name[0];
			return $this;
		}

		$this->fields[$type][] = $name;
		return $this;
	}

	/*

	*/
	public function create()
	{
		$headerSQL = 'CREATE TABLE '. $this->table . '(';
		$footerSQL = '); Engine='. $this->engine;
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
		if ($this->hasTable($this->table)) {
			return $this->add();
		}

		return $this->create();
	}


	/*
		
	*/
	public function hasTable()
	{
		return true;
	}


	/*
		
	*/
	public function hasField()
	{
		return true;
	}
}

$schema = new Schema();

$sql = $schema->table('user')
	   		  ->int('id')
	   		  ->string('nome')
	   		  ->string('sobrenome')
	   		  ->text('description')
	   		  ->engine('innoDB')
	   		  ->save();

print($sql);