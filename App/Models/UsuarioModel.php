<?php

namespace App\Models;
use App\Models\TipoUsuarioModel;
use PDO;

class UsuarioModel 
{
    private $idUsuario;
    private $cdUsuario;
    private $nmUsuario;
    private $email;
    private $senha;
    private $db;
    private TipoUsuarioModel $idTipoUsuario;

    public function __construct(PDO $db)
    {
        $this->db = $db;
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

    public function getCdUsuario()
    {
        return $this->cdUsuario;
    }

    public function setCdUsuario($cdUsuario)
    {
        $this->cdUsuario = $cdUsuario;
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

    public function getIdTipoUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdTipoUsuario(TipoUsuarioModel $tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;
    }

    public function create()
    {
        $sql = "INSERT INTO usuarios (cd_usuario, nm_usuario, email_usuario, senha_usuario)
                    VALUES (cd_usuario = :cd_usuario, nm_usuario = :nm_usuario, email_usuario = :email_usuario, 
                            senha_usuario = :senha_usuario, id_tipousuario = :id_tipousuario)";

        $senhaHash = password_hash($this->getSenha(), PASSWORD_DEFAULT);

        $stmt = $this->db->prepare($sql);
        
        $stmt->bindValue(":cd_usuario", $this->getCdUsuario());
        $stmt->bindValue(":nm_usuario", $this->getNmUsuario());
        $stmt->bindValue(":email_usuario", $this->getEmail());
        $stmt->bindValue(":senha_usuario", $senhaHash);
        $stmt->bindValue(":id_tipousuario", $this->getIdTipoUsuario());

        $stmt->execute();
    }
} 