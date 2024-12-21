<?php

class Router 
{
    private static $routes = [];

    public static function add($uri, $controller)
    {
        self::$routes[$uri] = $controller;
    }

    public static function getRoutes()
    {
        return self::$routes;
    }
}