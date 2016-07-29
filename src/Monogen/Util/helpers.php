<?php

if ( !function_exists('app_path') )
{
	function app_path( $path = '' )
	{
		return ROOT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $path;
	}
}

var_dump('ola mundo');