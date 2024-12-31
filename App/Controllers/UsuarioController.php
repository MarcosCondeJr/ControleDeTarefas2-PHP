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
        //Pega todos os tipos de usuarios e leva para o select na view
        $tipoUsuario = $this->tipoUsuario->getAll();

        //Gera um código
        $usuario = $this->perfilUsuario->getByCodigo();
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
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // $idUsuario      = $_POST['id_usuario'] ?? null;
            $cdUsuario      = $_POST['cd_usuario'] ?? null;
            $idTipousuario  = $_POST['id_tipousuario'] ?? null;
            $email          = $_POST['email_usuario'] ?? null;
            $nmUsuario      = $_POST['nm_usuario'] ?? null;
            $senha          = $_POST['confirmar_senha'] ?? null;
            $nmCompleto     = $_POST['nm_completo'] ?? null;
            $telefone       = $_POST['telefone_usuario'] ?? null;
            $descricao      = $_POST['ds_usuario'] ?? null;

            try
            {
                //Atribui os valores da table usuario.
                $tipoUsuario = new TipoUsuarioModel($this->db);
                $tipoUsuario = $tipoUsuario->getById($idTipousuario);

                $this->usuario->setTipoUsuario($tipoUsuario);
                $this->usuario->setNmUsuario($nmUsuario);
                $this->usuario->setEmail($email);
                $this->usuario->setSenha($senha);
                
                //Salva um Usuario
                $idUsuario = $this->usuario->create();
                
                //Atribui os valores na model de Perfil Usuário
                $usuario = new UsuarioModel($this->db);
                $idUsuario = $usuario->getById($idUsuario);
                
                $this->perfilUsuario->setIdUsuario($idUsuario);
                $this->perfilUsuario->setCdUsuario($cdUsuario);
                $this->perfilUsuario->setNmCompleto($nmCompleto);
                $this->perfilUsuario->setTelefone($telefone);
                $this->perfilUsuario->setDsUsuario($descricao);

                //Salva o perfil
                $this->perfilUsuario->create();

                $sucesso = true;
                RenderView::loadView('Usuario', 'CadastroUsuarioView', ['sucesso' => $sucesso] );
                exit();
            }
            catch(Exception $e)
            {
                $error = $e->getMessage();
            }
        }
        RenderView::loadView('Usuario', 'CadastroUsuarioView', ['error' => $error] );
    }
}