<?php

namespace App\Middleware;

use App\resources\{ Request, Response };

class checkProyect
{
	static function handler($app, Request $req){
		if(!$_ENV->proyect_exist($req->param("proyect_name")))
			throw new \Exception("This proyect does not exist.", 1);

		$app->proyect_name = $req->param("proyect_name");
		$app->proyect = $_ENV->proyects($req->param("proyect_name"));
		
		return 1;
	}
}