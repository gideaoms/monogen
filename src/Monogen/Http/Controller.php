<?php

namespace Monogen\Http\Controller;

abstract class Controller
{
	public abstract function urlNotFound()
	{
		echo "Url not found!!!";
	}
}