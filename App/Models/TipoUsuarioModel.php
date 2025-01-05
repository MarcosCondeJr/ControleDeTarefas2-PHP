<?php

namespace App\Models;
use PDO;
use App\Config\Connection;

class TipoUsuarioModel 
{
    private $idTipoUsuario;
    private $nmTipo;
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getIdTipoUsuario()
    {
        return $this->idTipoUsuario;
    }

    public function setIdTipoUsuario($idTipoUsuario)
    {
        $this->idTipoUsuario = $idTipoUsuario;
    }

    public function getNmTipo()
    {
        return $this->nmTipo;
    }

    public function setNmTipo($nmTipo)
    {
        $this->nmTipo = $nmTipo;
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM tipo_usuario");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tipo_usuario WHERE id_tipousuario = :id_tipo_usuario");
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        if ($result)
         {
            $tipoUsuario = new TipoUsuarioModel($this->db);
            $tipoUsuario->setIdTipoUsuario($result['id_tipousuario']);
            $tipoUsuario->setNmTipo($result['nm_tipo']);
  
            return $tipoUsuario;
        }
        return null;
    }
}