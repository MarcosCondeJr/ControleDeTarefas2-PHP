<?php

namespace App\Controllers;
use App\Models\TarefaModel;
use App\Models\UsuarioModel;
use App\Models\CategoriaModel;
use App\Service\TarefaService;
use App\Utils\RenderView;
use App\Config\Connection;
use Exception;

class TarefaController
{
    private $db;
    private $service;
    private $tarefa;
    private $usuario;
    private $categoria;

    public function __construct()
    {
        $this->db = (new Connection())->connect();
        $this->service = new TarefaService($this->db);
        $this->tarefa = new TarefaModel($this->db); 
        $this->usuario = new UsuarioModel($this->db);
        $this->categoria = new CategoriaModel($this->db);
    }
    public function index()
    {
        RenderView::loadView('Tarefa','ListTarefaView', []);
    }

    public function createView()
    {
        //Gera um código automaticamente para a tarefa
        $tarefa = $this->tarefa->getLastCodigo();
        $codigo = RenderView::gerarCódigo($tarefa, 'cd_tarefa');

        $usuario = $this->usuario->getAll();
        $categorias = $this->categoria->getAll();

        $data = [
            'codigo' => $codigo,
            'usuarios' => $usuario,
            'categorias' => $categorias
        ];

        RenderView::loadView('Tarefa','CadastroTarefaView', $data);
    }

    public function create()
    {
        $sucesso = false;
        $error = null;

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $object = json_decode(json_encode($_POST));

            try
            {
                
            }
            catch (Exception $e)
            {
                $error = $e->getMessage();
            }
        }
    }

}