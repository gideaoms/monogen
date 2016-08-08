<?php

namespace Monogen\Http;

class Request
{
	private $urlRequest;
	private $params = [];	

	public function __construct()
	{
		$this->urlRequest = $_SERVER['REQUEST_URI'];
	}

	public function callRequest(Route $route)
	{
		$route->setUrl( $this->urlRequest );
		foreach ($route->getRoutes() as $url => $config)
		{
			if ( $route->testEqualsUrl( $url ) and strtolower($_SERVER['REQUEST_METHOD']) == $config->type )
			{
				$class = "Younote\\Controllers\\{$config->class}";
				if (class_exists($class))
				{
					$controller = new $class;
					$method = $config->method;
					if (!method_exists($controller, $method))
						echo 'ERROR: method not found';
					else
					{
						$this->setParam($url);
						new Response($controller->$method($this));
						break;
					}
				}
				else
					echo 'ERROR: class not found';
			}			
		}
	}

	public function get( $index )
	{
		return filter_input(INPUT_GET, $index);
	}

	public function post($index = null)
	{
		if ($index)
			return filter_input(INPUT_POST, $index);
		return filter_input_array(INPUT_POST);
	}

	public function getParam($index)
	{
		return $this->params['{' . $index . '}'];
	}

	private function setParam($url)
	{
		$indexesUrl = explode('/', $url);
		$indexesRequest = explode('/', $this->urlRequest);
		foreach ($indexesUrl as $key => $value)
		{
			if (preg_match('/^\{(\w)+\}$/i', $value))
			{
				$this->params[$value] = $indexesRequest[$key];
			}
		}
	}

}