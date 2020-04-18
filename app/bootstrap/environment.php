<?php

namespace App\bootstrap;

use App\Middleware\loader as Middleware;
use App\resources\{ SSH, GitCommand };
use \phpseclib\{ Net\SSH2, Crypt\RSA };

class environment extends Middleware
{
	protected $app;

	function __construct(){
		parent::__construct();
	}

	function __set($param, $value){
		$this->app[$param] = $value;
	}

	function pull(){
		$command = new GitCommand($this->app['proyect']['repo']);
		$ssh = new SSH($this->app['proyect']['access']);

		return $ssh->exec($command->pull());
	}
}