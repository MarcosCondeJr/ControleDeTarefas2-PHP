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
        $tarefas = $this->tarefa->getAll();
        RenderView::loadView('Tarefa','ListTarefaView', ['tarefas' => $tarefas]);
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

        $categorias = $this->categoria->getAll();
        $usuarios = $this->usuario->getAll();

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $object = json_decode(json_encode($_POST));

            try
            {
                $this->service->create($object);
                $sucesso = true;
                RenderView::loadView('Tarefa', 'CadastroTarefaView', ['sucesso' => $sucesso]);
                exit();
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }
        RenderView::loadView('Tarefa', 'CadastroTarefaView', [
            'error' => $error,
            'categorias' => $categorias,
            'usuarios' => $usuarios
        ]);
    }

}