<?php

namespace Monogen\Http;

class Route
{
	private $url;

	public function getRoutes()
	{
		return require app_path('Requests/Routes/routes.php');
	}

	public function testEqualsUrl( $urlRoute )
	{		
		$newUrlRoute = preg_replace(['/\{(\w)+\}/i', '/\//'], ['[\d{1,}\w-]+', '\/'], $urlRoute);
		if ( preg_match('/^' . $newUrlRoute . '$/', $this->url) )
		{
			return true;
		}
		return false;
	}

	public function setUrl( $url )
	{
		$arrayUrl = explode('?', $url);
		$this->url = rtrim( $arrayUrl[0], '/' );
	}	
}
