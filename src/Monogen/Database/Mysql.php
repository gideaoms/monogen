<?php

namespace Monogen\Database;

use Monogen\System\Config;

class Mysql extends Connection
{
	private $config;
	private $table;
	private $data;
	private $sql;
	private $resultset;

	public function __construct()
	{		
		$this->config = Config::getValue('database.connections.mysql');

		$this->drive = $this->config->driver;
		$this->host = $this->config->host;
		$this->dbname = $this->config->database;
		$this->user = $this->config->username;
		$this->password = $this->config->password;
		$this->charset = $this->config->charset;
		parent::__construct();
	}

	public function insert($table, array $data)
	{
		$this->table = (string) $table;
		$this->data = $data;
		$this->getSyntax();
		$rs = $this->getConnection()->prepare($this->sql);
		$rs->execute($this->data);
		$this->resultset = $this->getConnection()->lastInsertId();
	}

	private function getSyntax() {
        $fileds = implode(', ', array_keys($this->data));
        $places = ':' . implode(', :', array_keys($this->data));
        $this->sql = "INSERT INTO {$this->tabela} ({$fileds}) VALUES ({$places})";
    }
}