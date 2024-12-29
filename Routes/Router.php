<?php

$routes = [
    '/' => 'HomeController@index',
    '/categoria' => 'CategoriaController@index',
    '/cadastro-categoria' => 'CategoriaController@createView',
    '/create-categoria' => 'CategoriaController@create',
    '/delete-categoria' => 'CategoriaController@delete',
    '/editar-categoria' => 'CategoriaController@updateView',
    '/update-categoria' => 'CategoriaController@update'
];