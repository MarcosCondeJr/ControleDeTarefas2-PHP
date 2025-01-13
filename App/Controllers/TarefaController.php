<?php

namespace App\Controllers;
use App\Models\TarefaModel;
use App\Service\TarefaService;
use App\Utils\RenderView;
use App\Config\Connection;
use Exception;

class TarefaController
{
    private $db;
    private $service;
    private $tarefa;

    public function __construct()
    {
        $this->db = (new Connection())->connect();
        $this->service = new TarefaService($this->db);
        $this->tarefa = new TarefaModel($this->db); 
    }
    public function index()
    {
        RenderView::loadView('Tarefa','ListTarefaView', []);
    }

    public function createView()
    {
        RenderView::loadView('Tarefa','CadastroTarefaView', []);
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