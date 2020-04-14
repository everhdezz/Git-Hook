<?php

namespace App\libs;

class Request
{
	private $headers;
	private $content;

	function __construct(){
		$this->headers = $_SERVER;
		$this->content = @file_get_contents("php://input");
	}

	function getContent(){
		return $this->content;
	}

	function getHeader($header){
		return $this->headers[strtoupper( "HTTP_$header" )] ?? false;
	}
}