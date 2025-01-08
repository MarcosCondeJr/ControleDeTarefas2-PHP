<?php

namespace App\Models;
use App\Models\TipoHorarioModel;
use App\Models\TarefaModel;
use PDO;

class HorarioTarefaModel
{
    private $idHorario;
    private TarefaModel $tarefa;
    private TipoHorarioModel $tipoHorario;
    private $dtHoraTarefa;
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->tarefa = new TarefaModel($this->db);
        $this->tipoHorario = new TipoHorarioModel($this->db);
    }

    public function getIdHorario()
    {
        return $this->idHorario;
    }

    public function setIdHorario($idHorario)
    {
        $this->idHorario = $idHorario;
    }

    public function getTarefa()
    {
        return $this->tarefa;
    }

    public function setTarefa(TarefaModel $tarefa)
    {
        $this->tarefa = $tarefa;
    }

    public function getTipoHorario()
    {
        return $this->tipoHorario;
    }

    public function setTipoHorario(TipoHorarioModel $tipoHorario)
    {
        $this->tipoHorario = $tipoHorario;
    }

    public function getDtHoraTarefa()
    {
        return $this->dtHoraTarefa;
    }

    public function setDtHoraTarefa($dtHoraTarefa)
    {
        $this->dtHoraTarefa = $dtHoraTarefa;
    }  
}