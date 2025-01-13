<?php

namespace App\Service;
use PDO;
use App\Models\TarefaModel;

class TarefaService 
{
    private $db;
    private $tarefa;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->tarefa = new TarefaModel($this->db);
    }

    /**
     * Função Responsável pela a regra de negócio e a criação da tarefa
     * @author: Marcos Conde
     * @created: 13/01/2025
     * $param: objeto com os valores do formulário;
     */
    public function create($object)
    {
        
    }
}