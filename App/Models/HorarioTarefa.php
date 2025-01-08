<?php

namespace App\Models;
use PDO;

class HorarioTarefa
{
    private $idHorario;
    private $tarefa;
    private $tipoHorario;
    private $dtHoraTarefa;
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
}