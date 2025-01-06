<?php

namespace App\Modelsuse;
use App\Models\UsuarioModel;
use App\Config\Connection;
use PDO;

class Auth 
{
    private $db;
    private $email;
    private $senha;
    private $nmUsuario;
    private $usuario;

    public function __construct(PDO $db) 
    {
        $this->db = $db;
        $this->usuario = new UsuarioModel($this->db);
    }

    public function validaLogin()
    {
        $sql = "SELECT * FROM usuarios 
                WHERE email_usuario = :email_usuario AND senha_usuario = :senha_usuario";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email_usuario', $_POST['email']);
        $stmt->bindValue(':senha_usuario', $_POST['senha']);

        $stmt->execute();
        return $stmt->fetch();
    }
}