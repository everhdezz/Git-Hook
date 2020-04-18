<?php

namespace App\Middleware;

use App\resources\{ Request, Response };

class auth
{
	private static $methods = [
		'github' => AuthMethods\GitHub::class
	];

	static function handler($app, Request $req){
		if(self::method_exists($req->param("auth_method")) && self::check_configuration($req->param("auth_method"))){
			$method_class = self::$methods[$req->param("auth_method")];

			if(!$method_class::Check())
				throw new \Exception("You do not have permission to access this module.", 1);
		}
	}

	private static function method_exists($method){
		if(!in_array($method, array_keys(self::$methods)))
			throw new \Exception("This method does not exist", 1);

		return 1;
	}

	private static function check_configuration($method){
		if(!$_ENV->auth_method_exist($method))
			throw new \Exception("This auth method is not configured", 1);

		return 1;
	}
}