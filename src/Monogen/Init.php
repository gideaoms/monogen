<?php

namespace monogen;

use Monogen\Http\Request;

class Init
{

	public static function start(Request $request)
	{
		$request->configUrl((require app_path('Requests/Routes/routes.php')));
	}

}