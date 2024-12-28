<?php

$routes = [
    '/' => 'HomeController@index',
    '/categoria' => 'CategoriaController@index',
    '/cadastro-categoria' => 'CategoriaController@createView',
    '/create-categoria' => 'CategoriaController@create'
];