<?php

$routes = [
    '/' => 'HomeController@index',

    //Rotas da Categoria
    '/categoria' => 'CategoriaController@index',
    '/cadastro-categoria' => 'CategoriaController@createView',
    '/create-categoria' => 'CategoriaController@create',
    '/delete-categoria' => 'CategoriaController@delete',
    '/editar-categoria' => 'CategoriaController@updateView',
    '/update-categoria' => 'CategoriaController@update',

    //Rotas do Usuario
    '/users' => 'UserController@index',
    '/cadastro-user' => 'UserController@createView'
];