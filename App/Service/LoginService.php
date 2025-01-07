<?php

namespace App\Service;
use App\Controller\LoginController;
use App\Models\Login;
use App\Config\Connection;
use Exception;
use PDOException;
use PDO;

class LoginService
{
    private $db;
    private $login;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->login = new Login($this->db);
    }

    public function login($object)
    {
        $email = $object->email_usuario;
        $senha = $object->senha_usuario;

        $auth = $this->login->validaLogin($email, $senha);

        if($auth == true)
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['auth'] = true;
            $_SESSION['usuario'] = $auth['usuario'];
        }
        else
        {
            $_SESSION['auth'] = false;
            throw new Exception("Email ou senha inválida!");
        }
    }
}
