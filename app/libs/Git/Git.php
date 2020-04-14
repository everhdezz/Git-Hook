<?php

namespace App\libs\Git;

class Git {

    private $dir;
    private $origin = 'master';

    function __construct(){
        $this->setDir($_ENV->get('dir'))->setOrigin($_ENV->get('origin'));
    }

    function setDir($dir = ''){
        $this->dir = $dir ?: dirname(getcwd());

        return $this;
    }

    function setOrigin($origin = ''){
        $this->origin = $origin ?: 'master';

        return $this;
    }

    function pull(){
        $this->exec("git pull origin $this->origin");

        return $this;
    }

    function exec($command){
        exec( "cd $this->dir && $command > $this->dir/custom.log &" );
    }
}