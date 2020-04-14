<?php
include 'vendor/autoload.php';

$_ENV = new App\Conf;

use App\libs\Git\{ oAuth, Git };

oAuth::Check() or die("You do not have permission to access this module.");

$git = new Git;
$git->pull();