<?php

namespace Monogen;

use Monogen\Http\Request;
use Monogen\Http\Route;

class App
{

	public function start(Request $request)
	{
		$request->callRequest(new Route);
	}

}