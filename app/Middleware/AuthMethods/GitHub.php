<?php

namespace App\Middleware\AuthMethods;

use App\resources\{ Request, Response };

class GitHub
{
    private static $method;
    private static $token;

    private function __construct(){}

    static function Check(){
        return self::validate_x_hub_signature() && self::validate_content();
    }

    private static function validate_x_hub_signature(){
    	$request = new Request;

        return $request->getHeader("X_HUB_SIGNATURE") && list(self::$method, self::$token) = explode("=", $request->getHeader("X_HUB_SIGNATURE"), 2);
    }

    private static function validate_content(){
    	$request = new Request;

    	return self::$token === hash_hmac(self::$method??'sha1', $request->getContent(), $_ENV->auth_methods("github")['access_token']);
    }
}