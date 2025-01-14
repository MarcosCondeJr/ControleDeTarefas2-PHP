<?php

namespace App\Service;

use App\Models\SituacaoModel;
use App\Models\UsuarioModel;
use App\Models\CategoriaModel;
use PDO;
use App\Models\TarefaModel;
use Exception;

class TarefaService 
{
    private $db;
    private $tarefa;
    private $situacao;
    private $usuario;
    private $categoria;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->tarefa = new TarefaModel($this->db);
        $this->situacao = new SituacaoModel($this->db);
        $this->usuario = new UsuarioModel($this->db);
        $this->categoria = new CategoriaModel($this->db);
    }

    /**
     * Função Responsável pela a regra de negócio e a criação da tarefa
     * @author: Marcos Conde
     * @created: 13/01/2025
     * $param: objeto com os valores do formulário;
     */
    public function create($object)
    {
        
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
        
        $situacao = $this->situacao->getById(1);
        $usuario = $this->usuario->getById($object->id_usuario);
        $categoria = $this->categoria->getByCategoria($object->id_categoria);
        
        $this->tarefa->setCdTarefa($object->cd_tarefa);
        $this->tarefa->setTituloTarefa($object->titulo_tarefa);
        $this->tarefa->setUsuario($usuario);
        $this->tarefa->setCategoria($categoria);
        $this->tarefa->setDsTarefa($object->titulo_tarefa);
        $this->tarefa->setSituacao($situacao);

        $this->tarefa->create();
    }
}