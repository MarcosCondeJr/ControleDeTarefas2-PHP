<?php

namespace App\Service;
use App\Config\Connection;
use App\Models\CategoriaModel;
use Exception;
use PDOException;
use PDO;

class CategoriaService 
{
    private $db;
    private $categoria;

    public function __construct(PDO $db) 
    {
        $this->db = $db;
        $this->categoria = new CategoriaModel($this->db);
    }

    /**
     * Função Responsável pela a regra de negócio e a criação da categoria
     * @author: Marcos Conde
     * @created: 02/01/2025
     * $param: array com os campos do formulario;
     */
    public function create($data)
    {
        $categoria = $this->categoria->getByCodigo($data['cd_categoria']);

        if(!empty($categoria))
        {
            throw new Exception("Já existe uma categoria com o código {$data['cd_categoria']}");
        }
            
        if(empty(trim($data['nm_categoria'])))
        {
            throw new Exception('O Campo Nome é obrigatório!');
        }

        $this->categoria->setCdCategoria($data['cd_categoria']);
        $this->categoria->setNmCategoria($data['nm_categoria']);
        $this->categoria->setDsCategoria($data['ds_categoria']);

        //Cria a categoria
        $this->categoria->create();
    }

    /**
     * Função Responsável pela a regra de negócio e a edição da categoria
     * @author: Marcos Conde
     * @created: 02/01/2025
     * $param: array com os campos do formulario;
     */
    public function update($data)
    {
        if(empty(trim($data['nm_categoria'])))
        {
            throw new Exception('O Campo Nome é obrigatório!');
        }

        $this->categoria->setIdCategoria($data['id_categoria']);
        $this->categoria->setCdCategoria($data['cd_categoria']);
        $this->categoria->setNmCategoria($data['nm_categoria']);
        $this->categoria->setDsCategoria($data['ds_categoria']);

        //Atualiza a categoria
        $this->categoria->update();
    }
}