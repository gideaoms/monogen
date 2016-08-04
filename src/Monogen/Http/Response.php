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
		if (is_array($this->data))
		{
			$this->echoJson();
			return true;
		}
		else if (is_object($this->data))
		{
			$this->data = (array) $this->data;
			$this->echoJson();
			return true;	
		}
		echo 'ERROR: data is not array.';
	}

	private function echoJson()
	{
		echo json_encode($this->data);
	}
}