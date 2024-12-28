<?php

namespace App\Models;
use PDO;
use App\Config\Connection;

class CategoriaModel 
{
    private $cdCategoria;
    private $nmCategoria;
    private $dsCategoria;
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Getters e Setters
     */
    public function setCdCategoria($cdCategoria)
    {
        $this->cdCategoria = $cdCategoria;
    }

    public function getCdCategoria()
    {
        return $this->cdCategoria;
    }

    public function setNmCategoria($nmCategoria)
    {
        $this->nmCategoria = $nmCategoria;
    }

    public function getNmCategoria()
    {
        return $this->nmCategoria;
    }

    public function setDsCategoria($dsCategoria)
    {
        $this->dsCategoria = $dsCategoria;
    }

    public function getDsCategoria()
    {
        return $this->dsCategoria;
    }

    /**
     * Função Responsável por salvar uma categoria
     * @author: Marcos Conde
     * @created: 27/12/2024
     */
    public function create()
    {
        $sql = 
            "INSERT INTO categoria (cd_categoria, nm_categoria, ds_categoria)
             VALUES (:cd_categoria, :nm_categoria, :ds_categoria)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":cd_categoria", $this->getCdCategoria());
        $stmt->bindValue(":nm_categoria", $this->getNmCategoria());
        $stmt->bindValue(":ds_categoria", $this->getDsCategoria());
        
        // $stmt->execute();
    }

    /**
     * Função Responsável por Buscar as Categorias
     * @author: Marcos Conde
     * @created: 27/12/2024
     */
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM categoria");
        return $stmt->fetchAll();
    }

    /**
     * Função Responsável por Buscar o ultimo codigo
     * @author: Marcos Conde
     * @created: 27/12/2024
     */
    public function getByCodigo()
    {
        $stmt = $this->db->query("SELECT * FROM categoria ORDER BY cd_categoria DESC LIMIT 1");
        return $stmt->fetch();
    }    
}