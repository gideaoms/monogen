<?php

namespace Monogen;

use Monogen\Http\Request;
use Monogen\Http\Route;

class Init
{

	public static function start(Request $request)
	{
		$request->callRequest(new Route);
	}

}