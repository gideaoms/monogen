<?php

namespace Monogen\Database;

use Monogen\System\Config;

abstract class Model
{
	protected $table;

	private $database;

	public function __construct()
	{
		$default = Config::getValue('database.default');
		switch ($default) {
			case 'mysql':
				$this->database = new Mysql();
				break;
			default:
				echo 'ERROR: database not configured.';
				die;
		}
	}

	public function save(array $data)
	{
		$this->database->insert($this->table, $data);
	}

	public function all($query)
	{
		return $this->database->selectAll($query);
	}

	public function find($query, array $where)
	{
		$rs = $this->database->selectOne($query, $where);
		if (isset($rs[0]))
			return [$rs[0]];
		return false;
	}
}