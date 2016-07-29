<?php

namespace Monogen\Http;

class Request
{
	private $url;
	private $parameters;

	public function configUrl(array $routes)
	{
		
		$this->explodeUri( $_SERVER['REQUEST_URI'] );

		var_dump($this->url);
		echo '<br>';

		foreach ($routes as $url => $configs)
		{
			$ereg = '/^' . str_replace('/', '\\/', $url) . '$/';
			var_dump($ereg);
			if (preg_match($ereg, $url))
			{
				echo '<br>passo aqui ' . $url . '<br>';
			}
		}
	}

	public function get( $index )
	{
		// retornar os parametros que foram passados por $_GET
	}

	public function post( $index )
	{
		// retornar os parametros que foram passado por $_POST
	}

	public function file( $index )
	{
		// retorna um arquivo file
	}

	public function files( $index )
	{
		// retornar todos os arquivos files
	}

	private function explodeUri( $uri )
	{
		$newUri = explode('?', $uri);
		$this->url = $newUri[0];		
		$this->parameters = isset( $newUri[1] ) ? $newUri[1] : "";
	}
}