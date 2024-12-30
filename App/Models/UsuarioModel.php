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
} 