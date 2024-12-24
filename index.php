<?php
require_once 'vendor/autoload.php';
require_once 'Core/Core.php';
require_once 'Routes/Router.php';

$core = new Core();
$core->run($routes);