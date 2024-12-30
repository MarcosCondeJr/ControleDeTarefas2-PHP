<?php

namespace App\Controllers;
use App\Utils\RenderView;
use App\Config\Connection;
use App\Models\UsuarioModel;
use App\Models\TipoUsuarioModel;
use Exception;

class UsuarioController 
{
    private $tipoUsuario;
    private $user;
    private $db;

    public function __construct()
    {
        $this->db = (new Connection())->connect();
        $this->tipoUsuario = new TipoUsuarioModel($this->db);
    }

    public function index()
    {
        RenderView::loadView('Usuario', 'ListUsuarioView', []);
    }

    public function createView()
    {
        $tipoUsuario = $this->tipoUsuario->getAll();
        RenderView::loadView('Usuario', 'CadastroUsuarioView', ['tipoUsuario' => $tipoUsuario]);
    }
}