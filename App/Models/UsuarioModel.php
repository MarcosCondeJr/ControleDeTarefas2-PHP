<?php

namespace App\Models;
use App\Models\TipoUsuarioModel;
use PDO;

class UsuarioModel 
{
    private $idUsuario;
    private $nmUsuario;
    private $email;
    private $senha;
    private $db;
    private TipoUsuarioModel $tipoUsuario;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->tipoUsuario = new TipoUsuarioModel($this->db);
    }

    /**
     * Getters e Setters
     */

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getNmUsuario()
    {
        return $this->nmUsuario;
    }

    public function setNmUsuario($nmUsuario)
    {
        $this->nmUsuario = $nmUsuario;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getTipoUsuario()
    {
        return $this->tipoUsuario;
    }

    public function setTipoUsuario(TipoUsuarioModel $tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;
    }

    public function create()
    {
        $sql = "INSERT INTO usuarios (nm_usuario, email_usuario, senha_usuario, id_tipousuario)
                    VALUES (:nm_usuario, :email_usuario, :senha_usuario, :id_tipousuario)";

        $senhaHash = password_hash($this->getSenha(), PASSWORD_DEFAULT);

        $stmt = $this->db->prepare($sql);
        
        $stmt->bindValue(":nm_usuario", $this->getNmUsuario());
        $stmt->bindValue(":email_usuario", $this->getEmail());
        $stmt->bindValue(":senha_usuario", $senhaHash);
        $stmt->bindValue(":id_tipousuario", $this->getTipoUsuario()->getIdTipoUsuario());

        $stmt->execute();
    }
} 