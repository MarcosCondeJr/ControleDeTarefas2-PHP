<?php

$routes = [
    '/' => 'LoginController@LoginView',
    '/login' => 'LoginController@Login',
    '/logout' => 'LoginController@LogOut',
    '/home' => 'LoginController@index',

    //Rotas da Categoria
    '/categoria' => 'CategoriaController@index',
    '/cadastro-categoria' => 'CategoriaController@createView',
    '/create-categoria' => 'CategoriaController@create',
    '/delete-categoria' => 'CategoriaController@delete',
    '/editar-categoria' => 'CategoriaController@updateView',
    '/update-categoria' => 'CategoriaController@update',
    '/categoria-search' => 'CategoriaController@search',

    //Rotas do Usuario
    '/usuarios' => 'UsuarioController@index',
    '/cadastro-usuario' => 'UsuarioController@createView',
    '/create-usuario' => 'UsuarioController@create',
    '/delete-usuario' => 'UsuarioController@delete',
    '/editar-usuario' => 'UsuarioController@updateView',
    '/update-usuario' => 'UsuarioController@update',
    '/usuario-search' => 'UsuarioController@search'
];