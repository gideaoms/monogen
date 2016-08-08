<?php

if (!function_exists('app_path'))
{
	function app_path($path = '')
	{
		return local_disk() . 'app' . DIRECTORY_SEPARATOR . $path;
	}
}

if (!function_exists('get_config'))
{
	function get_config()
	{
		return local_disk() . 'config' . DIRECTORY_SEPARATOR . 'app.json';
	}
}

if (!function_exists('get_routes'))
{
	function get_routes()
	{
		return local_disk() . 'config' . DIRECTORY_SEPARATOR . 'routes.json';
	}
}

if (!function_exists('local_disk'))
{
	function local_disk()
	{
		return LOCAL_DISK . DIRECTORY_SEPARATOR;
	}
}