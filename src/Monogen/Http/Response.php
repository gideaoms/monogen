<?php

namespace Monogen\Http;

class Response
{
	private $data;

	public function __construct($data)
	{
		$this->data = $data;
		$this->showJson();
	}

	private function showJson()
	{
		echo json_encode($this->data);
	}
}