<?php

namespace App\resources;

use App\resources\SSH;

class GitCommand
{
    private $git = '/usr/bin/git';
    private $dir = '/var/www/html';
    private $origin = 'master';

    function __construct($proyect){
        $this->dir = $proyect["dir"];
        $this->origin = $proyect["origin"];
    }

    function pull(){
        return $this->command("pull origin $this->origin");
    }

    function push(){
        return $this->command("push origin $this->origin");
    }

    private function command($command){
        return "cd $this->dir;$this->git $command";
    }
}