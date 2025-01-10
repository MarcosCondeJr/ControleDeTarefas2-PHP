<?php

namespace App\Controllers;
use App\Utils\RenderView;
use App\Config\Connection;
use Exception;
use PDOException;

class TarefaController
{
    public function index()
    {
        RenderView::loadView('Tarefa','ListTarefaView', []);
    }

    public function createView()
    {
        RenderView::loadView('Tarefa','CadastroTarefaView', []);
    }
}