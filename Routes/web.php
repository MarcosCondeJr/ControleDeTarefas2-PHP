<?php

require_once '../Routes/Router.php';
$route = new Router();

$route->add('/', 'HomeController');
$route->add('/user', 'UserController');
