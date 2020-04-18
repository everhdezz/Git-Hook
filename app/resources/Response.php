<?php

namespace App\resources;

class Response
{
	static function __callStatic($method, $content){
		return json_encode([
			'status' => $method,
			'message' => $content ?: ''
		]);
	}
}