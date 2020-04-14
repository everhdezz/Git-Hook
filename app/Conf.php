<?php

namespace App;

class Conf
{
	private $configurations;

	function __construct($conf_file = './conf.php'){
		$this->configurations = include $conf_file;
	}

	function get($param){
		return $this->configurations[strtoupper( $param )] ?? "";
	}

	function set($param, $value = ''){

		$this->configurations[$strtoupper( $param )] = $value;
		return $this;
	}
}