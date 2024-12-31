<?php

namespace App\Controllers;
use App\Utils\RenderView;
use App\Config\Connection;
use App\Models\UsuarioModel;
use App\Models\PerfilModel;
use App\Models\TipoUsuarioModel;
use Exception;

class UsuarioController 
{
    private $tipoUsuario;
    private $usuario;
    private $perfilUsuario;
    private $db;

    public function __construct()
    {
        $this->db = (new Connection())->connect();
        $this->tipoUsuario = new TipoUsuarioModel($this->db);
        $this->usuario = new UsuarioModel($this->db);
        $this->perfilUsuario = new PerfilModel($this->db);
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

    public function create()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // $idUsuario      = $_POST['id_usuario'] ?? null;
            $cdUsuario      = $_POST['cd_usuario'] ?? null;
            $idTipousuario  = $_POST['id_tipousuario'] ?? null;
            $email          = $_POST['email'] ?? null;
            $nmUsuario      = $_POST['nm_usuario'] ?? null;
            $senha          = $_POST['confirmar_senha'] ?? null;
            $nmCompleto     = $_POST['nm_completo'] ?? null;
            $telefone       = $_POST['telefone_usuario'] ?? null;
            $descricao      = $_POST['ds_usuario'] ?? null;

            //Atribui os valores e cria o usuario.
            // $this->usuario->setIdUsuario($idUsuario);
            
            $tipoUsuario = new TipoUsuarioModel($this->db);
            $tipoUsuario = $tipoUsuario->getById($idTipousuario);
            var_dump($tipoUsuario);

            $this->usuario->setTipoUsuario($tipoUsuario);
            $this->usuario->setEmail($email);
            $this->usuario->setSenha($senha);
            
            $this->usuario->create();

            $usuario = new UsuarioModel($this->db);
            $idUsuario = $usuario->getIdUsuario();
            var_dump($idUsuario);
            
            //Atribui os valores na model de Perfil Usuário

            $this->perfilUsuario->setIdUsuario($idUsuario);
            $this->perfilUsuario->setCdUsuario($cdUsuario);
            $this->perfilUsuario->setNmCompleto($nmCompleto);
            $this->perfilUsuario->setTelefone($telefone);
            $this->perfilUsuario->setDsUsuario($descricao);

            $this->perfilUsuario->create();
        }
    }
}