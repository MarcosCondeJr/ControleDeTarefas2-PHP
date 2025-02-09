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
    private $perfilUsuario;

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
     * $param: objeto com os valores do formulário;
     */
    public function create($object)
    {
        //Validações 
        if(empty(trim($object->nm_usuario)))
        {
            throw new Exception("O Nome de Usuário é obrigatório!");
        }
        if(empty(trim($object->nm_completo)))
        {
            throw new Exception("O Nome Completo é obrigatório!");
        }
        if(empty(trim($object->email_usuario)))
        {
            throw new Exception("O Email é obrigatório!");
        }
        
        if(empty($object->telefone_usuario) )
        {
            throw new Exception("O Telefone é obrigatório!");
        }
        else if(strlen($object->telefone_usuario) < 15)
        {
            throw new Exception("O Telefone está incompleto!");
        }

        if(!is_numeric($object->id_tipousuario))
        {
            throw new Exception("O Tipo de Usuário é obrigatório!");
        }

        if(empty(trim($object->senha)))
        {
            throw new Exception("A Senha é obrigatório!");
        }
        else if(strlen($object->senha) < 8)
        {
            throw new Exception("A Senha precisa ter 8 caracteres!");
        }

        //Atribui os valores da table usuario.
        $tipoUsuario = new TipoUsuarioModel($this->db);
        $tipoUsuario = $tipoUsuario->getById($object->id_tipousuario);

        $this->usuario->setTipoUsuario($tipoUsuario);
        $this->usuario->setNmUsuario($object->nm_usuario);
        $this->usuario->setEmail($object->email_usuario);
        $this->usuario->setSenha($object->senha);
        
        //Salva um Usuario
        $idUsuario = $this->usuario->create();
        
        //Atribui os valores na model de Perfil Usuário
        $usuario = new UsuarioModel($this->db);
        $idUsuario = $usuario->getById($idUsuario);
        
        $this->perfilUsuario->setIdUsuario($idUsuario);
        $this->perfilUsuario->setCdUsuario($object->cd_usuario);
        $this->perfilUsuario->setNmCompleto($object->nm_completo);
        $this->perfilUsuario->setTelefone($object->telefone_usuario);
        $this->perfilUsuario->setDsUsuario($object->ds_usuario);

        //Salva o perfil
        $this->perfilUsuario->create();
    }

    /**
     * Função Responsável pela a regra de negócio e a edição de usuarios
     * @author: Marcos Conde
     * @created: 05/01/2025
     * $param: objeto com os valores do formulário;
     */
    public function update($object)
    {
        //Validações 
        if(empty(trim($object->nm_usuario)))
        {
            throw new Exception("O Nome de Usuário é obrigatório!");
        }
        if(empty(trim($object->nm_completo)))
        {
            throw new Exception("O Nome Completo é obrigatório!");
        }
        if(empty(trim($object->email_usuario)))
        {
            throw new Exception("O Email é obrigatório!");
        }
        
        if(empty($object->telefone_usuario) )
        {
            throw new Exception("O Telefone é obrigatório!");
        }
        else if(strlen($object->telefone_usuario) < 15)
        {
            throw new Exception("O Telefone está incompleto!");
        }

        if(!is_numeric($object->id_tipousuario))
        {
            throw new Exception("O Tipo de Usuário é obrigatório!");
        }

        //Atribui os valores da table usuario.
        $tipoUsuario = new TipoUsuarioModel($this->db);
        $tipoUsuario = $tipoUsuario->getById($object->id_tipousuario);
        
        $this->usuario->setIdUsuario($object->id_usuario);
        $this->usuario->setTipoUsuario($tipoUsuario);
        $this->usuario->setNmUsuario($object->nm_usuario);
        $this->usuario->setEmail($object->email_usuario);

        //Se o inserir uma nova senha, ele atribui a senha nova
        if(!empty(trim($object->senha)))
        {
            $this->usuario->setSenha($object->senha);   
        }
        
        //Atualiza o Usuario
        $idUsuario = $this->usuario->update($object->senha);
        
        //Atribui os valores na model de Perfil Usuário
        $usuario = new UsuarioModel($this->db);
        $idUsuario = $usuario->getById($idUsuario);
        
        $this->perfilUsuario->setIdUsuario($idUsuario);
        $this->perfilUsuario->setCdUsuario($object->cd_usuario);
        $this->perfilUsuario->setNmCompleto($object->nm_completo);
        $this->perfilUsuario->setTelefone($object->telefone_usuario);
        $this->perfilUsuario->setDsUsuario($object->ds_usuario);

        //Atualiza o perfil
        $this->perfilUsuario->update();
    }

    /**
     * Função Responsável pela a regra de negócio e a exclusão de usuarios
     * @created: 24/01/2025
     * $param: id do usuario;
     */
    public function delete($id)
    {
        $dependencia = $this->usuario->verificaDependencia($id);

        if(!empty($dependencia))
        {
            throw new Exception("Não é possivel deletar o usuário pois está vinculado a uma tarefa!");
        }

        $this->perfilUsuario->delete($id);
        $this->usuario->delete($id);
    }
}