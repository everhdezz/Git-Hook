<?php
include 'vendor/autoload.php';

$_ENV = new App\Configurations;

try {
	$git = new App\bootstrap\environment;

	print $git->pull();
} catch (\Exception $e) {
	print $e->getMessage();
}
