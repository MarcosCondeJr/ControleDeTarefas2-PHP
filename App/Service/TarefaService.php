<?php

namespace App\Service;

use App\Models\SituacaoModel;
use PDO;
use App\Models\TarefaModel;
use Exception;

class TarefaService 
{
    private $db;
    private $tarefa;
    private $situacao;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->tarefa = new TarefaModel($this->db);
        $this->situacao = new SituacaoModel($this->db);
    }

    /**
     * Função Responsável pela a regra de negócio e a criação da tarefa
     * @author: Marcos Conde
     * @created: 13/01/2025
     * $param: objeto com os valores do formulário;
     */
    public function create($object)
    {
        echo '<pre>';
        var_dump($object);
        echo '</pre>';
        $situacao = $this->situacao->getById(1);

        if(empty(trim($object->titulo_tarefa)))
        {
            throw new Exception('O campo título é obrigatório');
        }
        if(empty($object->id_usuario))
        {
            throw new Exception('O campo responsável é obrigatório');
        }
        if(empty($object->id_categoria))
        {
            throw new Exception('O campo categoria é obrigatório');
        }

        $this->tarefa->setCdTarefa($object->cd_tarefa);
        $this->tarefa->setUsuario($object->id_usuario);
        $this->tarefa->setCategoria($object->id_categoria);
        $this->tarefa->setDsTarefa($object->titulo_tarefa);
        $this->tarefa->setSituacao($situacao);

        $this->tarefa->create();
    }
}