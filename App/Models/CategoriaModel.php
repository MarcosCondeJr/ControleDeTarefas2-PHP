<?php

namespace App\Models;
use PDO;
use App\Config\Connection;

class CategoriaModel 
{
    private $idCategoria;
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
    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;
    }

    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

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
        
        $stmt->execute();
    }

    /**
     * Função Responsável por Buscar as Categorias
     * @author: Marcos Conde
     * @created: 27/12/2024
     */
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM categoria ORDER BY id_categoria");
        return $stmt->fetchAll();
    }

    /**
     * Função Responsável por Buscar a Categoria para a edição
     * @author: Marcos Conde
     * @created: 28/12/2024
     */
    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM categoria WHERE id_categoria = :id_categoria");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Função Responsável por Buscar o ultimo codigo, para gerar o código no cadastro
     * @author: Marcos Conde
     * @created: 27/12/2024
     */
    public function getLastCodigo()
    {
        $stmt = $this->db->query("SELECT * FROM categoria ORDER BY cd_categoria DESC LIMIT 1");
        return $stmt->fetch();
    }
    
    /**
     * Função Responsável por Buscar a categoria pelo código, para fazer validação
     * @author: Marcos Conde
     * @created: 02/01/2025
     * param: código que vem do formulario
     */
    public function getByCodigo($codigo)
    {
        $stmt = $this->db->prepare("SELECT cd_categoria FROM categoria WHERE cd_categoria = :cd_categoria");
        $stmt->execute([$codigo]);
        return $stmt->fetch();
    }

    /**
     * Função Responsável por Deletar a categoria
     * @author: Marcos Conde
     * @created: 28/12/2024
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM categoria WHERE id_categoria = :id_categoria");
        return $stmt->execute([$id]);
    }

    /**
     * Função Responsável por Atualizar a categia no banco
     * @author: Marcos Conde
     * @created: 28/12/2024
     * @param1: recebe o id da categoria
     */
    public function update()
    {
        $sql =
                "UPDATE categoria
                    SET id_categoria = :id_categoria, cd_categoria = :cd_categoria, nm_categoria = :nm_categoria, ds_categoria = :ds_categoria
                    WHERE id_categoria = :id_categoria";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id_categoria", $this->getIdCategoria());
        $stmt->bindValue(":cd_categoria", $this->getCdCategoria());
        $stmt->bindValue(":nm_categoria", $this->getNmCategoria());
        $stmt->bindValue(":ds_categoria", $this->getDsCategoria());
        
        $stmt->execute();
    }

    /**
     * Função que busca as categorias pela consulta
     * @author: Marcos Conde
     * @created: 29/12/2024
     * @param: recebe o filtro vindo campo de pesquisa
     */
    public function search($filtro)
    {
        $sql = "SELECT * FROM categoria WHERE ";

        if(is_numeric($filtro))
        {
            $sql .= "cd_categoria = :filtro";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":filtro", $filtro);
            $stmt->execute();
        }
        else 
        {
            $sql .= "nm_categoria ILIKE :likeFiltro OR
                     ds_categoria ILIKE :likeFiltro";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":likeFiltro", "%{$filtro}%");
            $stmt->execute();
        }
        return $stmt->fetchAll();
    }

}