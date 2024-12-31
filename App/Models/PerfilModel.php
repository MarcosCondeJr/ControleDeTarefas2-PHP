<?php

namespace App\Models;
use App\Models\UsuarioModel;
use PDO;

class PerfilModel 
{
    private $idPerfil;
    private UsuarioModel $idUsuario;
    private $nmCompleto;
    private $telefone;
    private $dsUsuario;
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Getters e Setters
     */

    public function getIdPerfil()
    {
        return $this->idPerfil;
    }

    public function setIdPerfil($idPerfil)
    {
        $this->idPerfil = $idPerfil;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(UsuarioModel $idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getNmCompleto()
    {
        return $this->nmCompleto;
    }

    public function setNmCompleto($nmCompleto)
    {
        $this->nmCompleto = $nmCompleto;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getDsUsuario()
    {
        return $this->dsUsuario;
    }

    public function setDsUsuario($dsUsuario)
    {
        $this->dsUsuario = $dsUsuario;
    }

    public function create()
    {
        $sql = "INSERT INTO perfil_usuario (id_usuario, nm_completo, telefone_usuario, ds_usuario)
                VALUES (id_usuario = :id_usuario, nm_completo = :nm_completo, telefone_usuario = :telefone_usuario, ds_usuario = :ds_usuario)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue("id_usuario", $this->getIdUsuario());
        $stmt->bindValue("nm_completo", $this->getNmCompleto());
        $stmt->bindValue("telefone_usuario", $this->getTelefone());
        $stmt->bindValue("ds_usuario", $this->getDsUsuario());

        $stmt->execute();
    }
} 