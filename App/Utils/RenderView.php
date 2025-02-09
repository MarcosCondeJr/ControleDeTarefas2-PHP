<?php

namespace App\Utils;

class RenderView 
{
    public static function loadView($pasta, $view, $data = [])
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if(isset($_SESSION['auth']) && $_SESSION['auth'] == true)
        {
            extract($data);
            require_once __DIR__ . "/../Views/{$pasta}/{$view}.php";
        }
        else
        {
            $error = 'Acesso negado. Por favor, faça login para continuar!';
            self::loadLogin('Login', 'LoginPage', ['error' => $error]);
            exit;
        }
    }

    public static function loadLogin($pasta, $view, $data = [])
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
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