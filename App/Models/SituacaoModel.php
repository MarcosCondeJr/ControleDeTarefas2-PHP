<?php

namespace App\Models;
use PDO;

class SituacaoModel 
{
    private $idSituacao;
    private $nmSituacao;
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getIdSituacao()
    {
        return $this->idSituacao;
    }

    public function setIdSituacao($idSituacao)
    {
        $this->idSituacao = $idSituacao;
    }

    public function getNmSituacao()
    {
        return $this->nmSituacao;
    }

    public function setNmSituacao($nmSituacao)
    {
        $this->nmSituacao = $nmSituacao;
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM situacao");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM situacao WHERE id_situacao = :id_situacao");
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        if ($result)
         {
            $situacao = new SituacaoModel($this->db);
            $situacao->setIdSituacao($result['id_situacao']);
            $situacao->setNmSituacao($result['nm_situacao']);
  
            return $situacao;
        }
        return null;
    }
}