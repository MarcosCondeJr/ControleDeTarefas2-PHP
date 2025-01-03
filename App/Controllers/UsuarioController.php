<?php

namespace App\Controllers;
use App\Utils\RenderView;
use App\Config\Connection;
use App\Models\UsuarioModel;
use App\Models\PerfilModel;
use App\Models\TipoUsuarioModel;
use App\Service\UsuarioService;
use Exception;

class UsuarioController 
{
    private $tipoUsuario;
    private $usuario;
    private $perfilUsuario;
    private $db;
    private $service;

    public function __construct()
    {
        $this->db = (new Connection())->connect();
        $this->tipoUsuario = new TipoUsuarioModel($this->db);
        $this->usuario = new UsuarioModel($this->db);
        $this->perfilUsuario = new PerfilModel($this->db);
        $this->service = new UsuarioService($this->db);
    }

    public function index()
    {
        $usuarios = $this->usuario->getAll();
        RenderView::loadView('Usuario', 'ListUsuarioView', ['usuarios' => $usuarios]);
    }

    public function createView()
    {
        //Pega todos os tipos de usuarios e leva para o select na view
        $tipoUsuario = $this->tipoUsuario->getAll();

        //Gera um código
        $usuario = $this->perfilUsuario->getLastCodigo();
        $codigo = RenderView::gerarCódigo($usuario, 'cd_usuario');

        $data = [
            'codigo' => $codigo,
            'tipoUsuario' => $tipoUsuario
        ];

        RenderView::loadView('Usuario', 'CadastroUsuarioView', $data);
    }

    public function create()
    {
        $sucesso = false;
        $error = null;
        $tipoUsuario = $this->tipoUsuario->getAll();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = $_POST;

            try
            {
                $this->service->create($data);
                $sucesso = true;
                RenderView::loadView('Usuario', 'CadastroUsuarioView', ['sucesso' => $sucesso] );
                exit();
            }
            catch(Exception $e)
            {
                $error = $e->getMessage();
            }
        }
        RenderView::loadView('Usuario', 'CadastroUsuarioView', ['error' => $error, 'tipoUsuario' => $tipoUsuario]);
    }
}