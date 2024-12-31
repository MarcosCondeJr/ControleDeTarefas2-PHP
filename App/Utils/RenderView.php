<?php

namespace App\Utils;

class RenderView 
{
    public static function loadView($pasta, $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/{$pasta}/{$view}.php";
    }

    public static function gerarCódigo($tabela, $coluna)
    {
        if(!empty($tabela))
        {
            $codigo = $tabela[$coluna] + 1;
        }
        else
        {
            $codigo = 1;
        }
        return $codigo;
    }
}