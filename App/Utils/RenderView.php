<?php

namespace App\Utils;

class RenderView 
{
    public static function loadView($view, $data)
    {
        extract($data);
        require_once __DIR__ . "/../Views/{$view}.php";
    }
}