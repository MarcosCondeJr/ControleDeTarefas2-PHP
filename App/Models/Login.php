<?php

namespace App\Models;
use PDO;

class Login 
{
    private $db;

    public function __construct(PDO $db) 
    {
        $this->db = $db;
    }

    public function validaLogin($email, $senha)
    {
        $sql = "SELECT * FROM usuarios 
                WHERE email_usuario = :email_usuario";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email_usuario', $email);
        $stmt->execute();
        $usuario = $stmt->fetch();

        if($usuario && password_verify($senha, $usuario['senha_usuario'])) 
        {
            return ['success' => true, 'usuario' => $usuario['nm_usuario']];
        }
        else
        {
            return false;
        }
    }
}