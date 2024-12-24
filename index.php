<?php
require_once 'vendor/autoload.php';
require_once 'Core/Core.php';
require_once 'Routes/Router.php';

spl_autoload_register(function($file) {
    if (file_exists(__DIR__."/App/Utils/$file.php")) {
      require_once __DIR__."/App/Utils/$file.php";
    }
    else if (file_exists(__DIR__."/App/Models/$file.php")) {
      require_once __DIR__."/App/Models/$file.php";
    }
  }); 

$core = new Core();
$core->run($routes);