<?php

namespace App\Middleware;
use App\resources\{ Request, Response };

class loader
{
	private $middlewares = [
		\App\Middleware\auth::class,
		\App\Middleware\checkProyect::class
	];

	function __construct(){
		foreach ($this->middlewares as $middleware){
			$req = new Request;

			$middleware::handler($this, $req);
		}
	}
}