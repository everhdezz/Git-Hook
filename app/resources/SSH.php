<?php

namespace App\resources;

use \phpseclib\{ Net\SSH2, Crypt\RSA };

class SSH
{
    private $host = 'localhost';
    private $user = 'root';
    private $key;

    private $ssh;

    function __construct($access){
        $this->host = $access['host'];
        $this->user = $access['user'];
        if(isset($access['cert']))
            $this->setCert($access['cert']);
        else
            $this->key = $access['pass'];

        $this->create_instance();
    }

    private function setCert($cert){
        $this->key = new RSA();
        $this->key->loadKey(file_get_contents("./certs/$cert"));

        return $this;
    }

    private  function create_instance(){
        $this->ssh = new SSH2($this->host);

        if (!$this->ssh->login($this->user, $this->key))
            throw new \Exception("Error trying to connect to ssh server " . json_encode($this->ssh->getErrors()), 1);
    }

    function exec($command){
        return $this->ssh->exec($command);
    }
}