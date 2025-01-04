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
     * $param: objeto com os valores do formulário;
     */
    public function create($object)
    {
        $categoria = $this->categoria->getByCodigo($object->cd_categoria);

        if(!empty($categoria))
        {
            throw new Exception("Já existe uma categoria com o código {$object->cd_categoria}");
        }
            
        if(empty(trim($object->nm_categoria)))
        {
            throw new Exception('O Campo Nome é obrigatório!');
        }

        $this->categoria->setCdCategoria($object->cd_categoria);
        $this->categoria->setNmCategoria($object->nm_categoria);
        $this->categoria->setDsCategoria($object->ds_categoria);

        //Cria a categoria
        $this->categoria->create();
    }

    /**
     * Função Responsável pela a regra de negócio e a edição da categoria
     * @author: Marcos Conde
     * @created: 02/01/2025
     * $param: objeto com os valores do formulário;
     */
    public function update($object)
    {
        if(empty(trim($object->nm_categoria)))
        {
            throw new Exception('O Campo Nome é obrigatório!');
        }
        
        $this->categoria->setIdCategoria($object->id_categoria);
        $this->categoria->setCdCategoria($object->cd_categoria);
        $this->categoria->setNmCategoria($object->nm_categoria);
        $this->categoria->setDsCategoria($object->ds_categoria);
        
        //Atualiza a categoria
        $this->categoria->update();
    }
}