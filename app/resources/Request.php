<?php

namespace App\resources;

class Request
{
	private $headers;
	private $content;
	private $params = [];

	function __construct(){
		$this->headers = $_SERVER;
		$this->content = @file_get_contents("php://input");
		$this->params = $this->parse_url($_GET['s']);
	}

	function parse_url($string){
		$params = array_filter(explode('/', $string));
		return [
			'auth_method' => $params[0] ?? '',
			'proyect_name' => $params[1] ?? '',
		];
	}

	function getContent(){
		return $this->content;
	}

	function getHeader($header){
		return $this->headers[strtoupper( "HTTP_$header" )] ?? false;
	}

	function param($param){
		return $this->params[$param] ?? '';
	}
}