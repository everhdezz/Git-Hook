<?php

namespace App;

class Configurations
{
	private $configurations;

	function __construct($conf_file = './conf.php'){
		$this->load_file($conf_file);
	}

	function load_file($conf_file){
		$this->configurations = include $conf_file;
	}

	function set($param, $value = ''){

		$this->configurations[$strtoupper( $param )] = $value;
		return $this;
	}

	function auth_method_exist(string $method){
		return in_array($method, array_keys($this->configurations['AUTH_METHODS']));
	}

	function proyect_exist(string $proyect_name){
		return in_array($proyect_name, array_keys($this->configurations['PROYECTS']));
	}

	function __call($param, $value){
		return $this->configurations[strtoupper( $param )][$value[0]];
	}
}