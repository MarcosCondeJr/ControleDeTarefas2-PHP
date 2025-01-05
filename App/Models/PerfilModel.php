<?php

namespace App\Models;
use App\Models\UsuarioModel;
use PDO;

class PerfilModel 
{
    private $idPerfil;
    private $cdUsuario;
    private UsuarioModel $idUsuario;
    private $nmCompleto;
    private $telefone;
    private $dsUsuario;
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->idUsuario = new UsuarioModel($this->db);
    }

    /**
     * Getters e Setters
     */

    public function getIdPerfil()
    {
        return $this->idPerfil;
    }

    public function setIdPerfil($idPerfil)
    {
        $this->idPerfil = $idPerfil;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(UsuarioModel $idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getCdUsuario()
    {
        return $this->cdUsuario;
    }

    public function setCdUsuario($cdUsuario)
    {
        $this->cdUsuario = $cdUsuario;
    }

    public function getNmCompleto()
    {
        return $this->nmCompleto;
    }

    public function setNmCompleto($nmCompleto)
    {
        $this->nmCompleto = $nmCompleto;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getDsUsuario()
    {
        return $this->dsUsuario;
    }

    public function setDsUsuario($dsUsuario)
    {
        $this->dsUsuario = $dsUsuario;
    }

    /**
     * Função Responsável por Buscar o perfil do usuario
     * @author: Marcos Conde
     * @created: 05/01/2025
     */
    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM perfil_usuario WHERE id_usuario = :id_usuario");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Função Responsável por Buscar o ultimo codigo, para gerar o código no cadastro
     * @author: Marcos Conde
     * @created: 31/12/2024
     */
    public function getLastCodigo()
    {
        $stmt = $this->db->query("SELECT * FROM perfil_usuario ORDER BY cd_usuario DESC LIMIT 1");
        return $stmt->fetch();
    }   

    /**
     * Função Responsável por Buscar o perfil pelo código, para fazer validação
     * @author: Marcos Conde
     * @created: 02/01/2025
     * param: código que vem do formulario
     */
    public function getByCodigo($codigo)
    {
        $stmt = $this->db->prepare("SELECT * FROM perfil_usuario WHERE cd_usuario = :cd_usuario");
        $stmt->execute([$codigo]);
        return $stmt->fetch();
    }

    /**
     * Função Responsável por criar o perfil do usuário
     * @author: Marcos Conde
     * @created: 01/01/2025
     */
    public function create()
    {
        $sql = "INSERT INTO perfil_usuario (cd_usuario, id_usuario, nm_completo, telefone_usuario, ds_usuario)
                VALUES (:cd_usuario, :id_usuario, :nm_completo, :telefone_usuario, :ds_usuario)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(":id_usuario", $this->getIdUsuario()->getIdUsuario());
        $stmt->bindValue(":cd_usuario", $this->getCdUsuario());
        $stmt->bindValue(":nm_completo", $this->getNmCompleto());
        $stmt->bindValue(":telefone_usuario", $this->getTelefone());
        $stmt->bindValue(":ds_usuario", $this->getDsUsuario());

        $stmt->execute();
    }

    /**
     * Função Responsável por deletar um perfil
     * @author: Marcos Conde
     * @created: 04/01/2025
     * param: id do usuário
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM perfil_usuario WHERE id_usuario = :id_usuario");
        return $stmt->execute([$id]);
    }
} 