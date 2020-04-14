<?php

namespace App\libs\Git;

use App\libs\Request;

class oAuth
{
    private static $method;
    private static $token;

    private function __construct(){}

    function Check(){
        return self::validate_x_hub_signature() && self::validate_content();
    }

    function validate_x_hub_signature(){
    	$request = new Request;

        return $request->getHeader("X_HUB_SIGNATURE") && list(self::$method, self::$token) = explode("=", $request->getHeader("X_HUB_SIGNATURE"), 2);
    }

    function validate_content(){
    	$request = new Request;

    	return self::$token === hash_hmac(self::$method??'sha1', $request->getContent(), $_ENV->get('TOKEN'));
    }
}