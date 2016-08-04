<?php

namespace Monogen\Database;

class Mysql extends Connection
{
	private $config;
	private $table;
	private $data;
	private $sql;
	private $resultset;

	public function __construct($config)
	{
		$this->config = $config;
		$this->drive = $config['default'];
		$this->host = $this->getIndexConfig('host');
		$this->dbname = $this->getIndexConfig('database');
		$this->user = $this->getIndexConfig('username');
		$this->password = $this->getIndexConfig('password');
		$this->charset = $this->getIndexConfig('charset');
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

	private function getIndexConfig($index)
	{
		return $this->config['connections']['mysql'][$index];
	}

	private function getSyntax() {
        $fileds = implode(', ', array_keys($this->data));
        $places = ':' . implode(', :', array_keys($this->data));
        $this->sql = "INSERT INTO {$this->tabela} ({$fileds}) VALUES ({$places})";
    }
}