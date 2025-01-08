<?php

namespace App\Models;
use PDO;

class TipoHorarioModel 
{
    private $idTipoHorario;
    private $nmTipoHorario;
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getIdTipoHorario()
    {
        return $this->idTipoHorario;
    }

    public function setIdTipoHorario($idTipoHorario)
    {
        $this->idTipoHorario = $idTipoHorario;
    }

    public function getNmTipoHorario()
    {
        return $this->nmTipoHorario;
    }

    public function setNmTipoHorario($nmTipoHorario)
    {
        $this->nmTipoHorario = $nmTipoHorario;
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM tipo_horario");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tipo_horario WHERE id_tipohorario = :id_tipohorario");
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        if ($result)
         {
            $tipoHorario = new TipoHorarioModel($this->db);
            $tipoHorario->setIdTipoHorario($result['id_tipohorario']);
            $tipoHorario->setNmTipoHorario($result['nm_tipohorario']);
  
            return $tipoHorario;
        }
        return null;
    }
}