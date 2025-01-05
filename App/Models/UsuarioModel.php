<?php

namespace App\Models;
use App\Models\TipoUsuarioModel;
use PDO;

class UsuarioModel 
{
    private $idUsuario;
    private $nmUsuario;
    private $email;
    private $senha;
    private $db;
    private TipoUsuarioModel $tipoUsuario;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->tipoUsuario = new TipoUsuarioModel($this->db);
    }

    /**
     * Getters e Setters
     */

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getNmUsuario()
    {
        return $this->nmUsuario;
    }

    public function setNmUsuario($nmUsuario)
    {
        $this->nmUsuario = $nmUsuario;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getTipoUsuario()
    {
        return $this->tipoUsuario;
    }

    public function setTipoUsuario(TipoUsuarioModel $tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;
    }

    /**
     * Função Responsável por Buscar o usuario para edição
     * @author: Marcos Conde
     * @created: 05/01/2025
     */
    public function getByUsuario($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id_usuario = :id_usuario");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id_usuario = :id_usuario");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        
        if ($result)
        {
            $usuario = new UsuarioModel($this->db);
            $usuario->setIdUsuario($result['id_usuario']);
            return $usuario;
        }
        return null;
    }

    //Busca os Usuarios e seu perfil
    public function getAll()
    {
        $sql = "SELECT
                    us.id_usuario,
                    pf.cd_usuario,
                    us.nm_usuario,
                    us.email_usuario,
                    pf.telefone_usuario,
                    tp.nm_tipo
                FROM
                    usuarios AS us
                JOIN
                    perfil_usuario AS pf ON pf.id_usuario = us.id_usuario
                JOIN
                    tipo_usuario AS tp ON tp.id_tipousuario = us.id_tipousuario
                ORDER BY 
                    cd_usuario";

        $stmt =$this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Função Responsável por criar um usuário
     * @author: Marcos Conde
     * @created: 01/01/2025
     */
    public function create()
    {
        $sql = "INSERT INTO usuarios (nm_usuario, email_usuario, senha_usuario, id_tipousuario)
                    VALUES (:nm_usuario, :email_usuario, :senha_usuario, :id_tipousuario)";

        $senhaHash = password_hash($this->getSenha(), PASSWORD_DEFAULT);

        $stmt = $this->db->prepare($sql);
        
        $stmt->bindValue(":nm_usuario", $this->getNmUsuario());
        $stmt->bindValue(":email_usuario", $this->getEmail());
        $stmt->bindValue(":senha_usuario", $senhaHash);
        $stmt->bindValue(":id_tipousuario", $this->getTipoUsuario()->getIdTipoUsuario());

        $stmt->execute();
        return $this->db->lastInsertId();
    }

    /**
     * Função Responsável por deletar um usuário
     * @author: Marcos Conde
     * @created: 04/01/2025
     * param: id do usuário
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id_usuario = :id_usuario");
        return $stmt->execute([$id]);
    }

    /**
     * Função Responsável por editar um usuário
     * @author: Marcos Conde
     * @created: 05/01/2025
     * @param: object da senha, para validar se foi inserido senha ou não, para salvar uma nova senha
     */
    public function update($senha)
    {
        $sql = "UPDATE usuarios
            SET id_usuario = :id_usuario, nm_usuario = :nm_usuario, email_usuario = :email_usuario, id_tipousuario = :id_tipousuario";

        //Se caso digitar uma nova senha, ele cria um hash da nova senha
        if(!empty(trim($senha)))
        {
            $sql .= ", senha_usuario = :senha_usuario WHERE id_usuario = :id_usuario";

            $senhaHash = password_hash($this->getSenha(), PASSWORD_DEFAULT);

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id_usuario", $this->getIdUsuario());
            $stmt->bindValue(":nm_usuario", $this->getNmUsuario());
            $stmt->bindValue(":email_usuario", $this->getEmail());
            $stmt->bindValue(":senha_usuario", $senhaHash);
            $stmt->bindValue(":id_tipousuario", $this->getTipoUsuario()->getIdTipoUsuario());
        }
        else 
        {
            $sql .= " WHERE id_usuario = :id_usuario";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id_usuario", $this->getIdUsuario());
            $stmt->bindValue(":nm_usuario", $this->getNmUsuario());
            $stmt->bindValue(":email_usuario", $this->getEmail());
            $stmt->bindValue(":id_tipousuario", $this->getTipoUsuario()->getIdTipoUsuario());
        }
        $stmt->execute();
        return $this->getIdUsuario();
    }
} 