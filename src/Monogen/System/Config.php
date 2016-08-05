<?php

namespace Monogen\System;

class Config
{
	private static $localJSON;

	public static function loadJson()
	{
		if (is_null(self::$localJSON))
		{
			self::$localJSON = json_decode(file_get_contents(get_config()));
			if (self::$localJSON)
				return true;
			
			self::$localJSON = null;
			return false;
		}
		return true;
	}

	public static function getValue($index)
	{
		if (self::loadJson())
		{
			$indexes = explode('.', $index);
			$newJson = self::$localJSON;
			foreach ($indexes as $value)
			{
				$newJson = $newJson->$value;
			}
			return $newJson;
		}
	}
	
}