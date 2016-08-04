<?php

namespace Monogen\Database;

use PDO;
use PDOException;

abstract class Connection
{
	protected static $connection;
	protected $drive;
	protected $host;
	protected $dbname;
	protected $user;
	protected $password;
	protected $charset;

	public function __construct()
	{
		$this->connect();
	}

	public function connect()
	{
		try
		{
			if (is_null(self::$connection))
			{
				$dns = "{$this->drive}:host={$this->host};dbname={$this->dbname}";				
				$options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$this->charset}"];

				self::$connection = new PDO($dns, $this->user, $this->password, $options);
				self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			}
		}
		catch(PDOException $e)
		{
			echo 'Error in the connection: ' . $e->getMessage();
			die;
		}
		return self::$connection;
	}

	public function selectAll($query)
	{
		$rs = $this->getConnection()->prepare($query);
		$rs->execute();
		return $rs->fetchAll();
	}

	public function selectOne($query, array $where)
	{
		$rs = $this->getConnection()->prepare($query);		
		$rs->execute($where);
		return $rs->fetchAll();
	}

	public function insert($query, array $data)
	{

	}

	public function delete($query, array $data)
	{

	}

	public function update($query, array $data)
	{

	}

	private function getConnection()
	{
		return $this->connect();
	}
}