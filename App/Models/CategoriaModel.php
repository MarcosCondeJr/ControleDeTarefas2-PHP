<?php

namespace App\Models;
use PDO;

class CategoriaModel 
{
    private $cdCategoria;
    private $nmCategoria;
    private $dsCategoria;
    private $db;

    public function __contruct(PDO $db)
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
}