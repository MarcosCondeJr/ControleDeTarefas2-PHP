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
            $idUsuario      = $_POST['id_usuario'] ?? null;
            $cdUsuario      = $_POST['cd_usuario'] ?? null;
            $idTipousuario  = $_POST['id_tipousuario'] ?? null;
            $email          = $_POST['email'] ?? null;
            $nmUsuario      = $_POST['nm_usuario'] ?? null;
            $senha          = $_POST['confirmar_senha'] ?? null;
            $nmCompleto     = $_POST['nm_completo'] ?? null;
            $telefone       = $_POST['telefone_usuario'] ?? null;
            $descricao      = $_POST['ds_usuario'] ?? null;

            var_dump($_POST);

            //Atribui os valores na model de usuario.
            $this->usuario->setIdUsuario($idUsuario);
            $this->usuario->setCdUsuario($cdUsuario);
            $this->usuario->setEmail($email);
            $this->usuario->setSenha($senha);
            
            //Erro ao atribui o id do tipo 
            $tipo = new TipoUsuarioModel($this->db);
            $tipo->setIdTipoUsuario($idTipousuario);

            //Atribui os valores na model de Perfil Usuário
            $this->perfilUsuario->setIdUsuario($idUsuario);
            $this->perfilUsuario->setNmCompleto($nmCompleto);
            $this->perfilUsuario->setTelefone($telefone);
            $this->perfilUsuario->setDsUsuario($descricao);

            $this->usuario->create();
            $this->perfilUsuario->create();
        }
    }
}