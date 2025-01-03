<?php

namespace App\Service;
use App\Config\Connection;
use App\Models\UsuarioModel;
use App\Models\PerfilModel;
use App\Models\TipoUsuarioModel;
use Exception;
use PDOException;
use PDO;

class UsuarioService
{
    private $db;
    private $usuario;
    private $perfil;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->usuario = new UsuarioModel($this->db);
        $this->perfilUsuario = new PerfilModel($this->db);
    }

    /**
     * Função Responsável pela a regra de negócio e a criação de usuarios
     * @author: Marcos Conde
     * @created: 02/01/2025
     * $param: array com os campos do formulario;
     */
    public function create($data)
    {
        $cdUsuario      = $data['cd_usuario'] ?? null;
        $idTipousuario  = $data['id_tipousuario'] ?? null;
        $email          = $data['email_usuario'] ?? null;
        $nmUsuario      = $data['nm_usuario'] ?? null;
        $senha          = $data['confirmar_senha'] ?? null;
        $nmCompleto     = $data['nm_completo'] ?? null;
        $telefone       = $data['telefone_usuario'] ?? null;
        $descricao      = $data['ds_usuario'] ?? null;

        //Validações 
        if(empty(trim($nmUsuario)))
        {
            throw new Exception("O Nome de Usuário é obrigatório!");
        }
        if(empty(trim($nmCompleto)))
        {
            throw new Exception("O Nome Completo é obrigatório!");
        }
        if(empty(trim($email)))
        {
            throw new Exception("O Email é obrigatório!");
        }
        
        if(empty($telefone) )
        {
            throw new Exception("O Telefone é obrigatório!");
        }
        else if(strlen($telefone) < 15)
        {
            throw new Exception("O Telefone está incompleto!");
        }

        if(!is_numeric($idTipousuario))
        {
            throw new Exception("O Tipo de Usuário é obrigatório!");
        }

        if(empty(trim($senha)))
        {
            throw new Exception("A Senha é obrigatório!");
        }
        else if(strlen($senha) < 8)
        {
            throw new Exception("A Senha precisa ter 8 caracteres!");
        }

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
    }
}