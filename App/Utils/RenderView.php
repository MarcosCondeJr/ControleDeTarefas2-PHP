<?php

namespace App\Utils;

class RenderView 
{
    public static function loadView($pasta, $view, $data)
    {
        extract($data);
        require_once __DIR__ . "/../Views/{$pasta}/{$view}.php";
    }
}