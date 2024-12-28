<?php

namespace App\Controllers;
use App\Utils\RenderView;
use App\Config\Connection;
use App\Models\CategoriaModel;

class CategoriaController
{
    private $messagem;
    private $db;
    private $categoria;

    public function __construct()
    {
        $this->db = (new Connection())->connect();
        $this->categoria = new CategoriaModel($this->db);
    }

    public function index()
    {
        $categorias = $this->categoria->getAll();
        RenderView::loadView('Categoria', 'ListCategoriaView', ['categorias' => $categorias]);
    }

    public function createView()
    {
        //Gera um código automaticamente
        $categoria = $this->categoria->getByCodigo();
        if(!empty($categoria))
        {
            $codigo = $categoria['cd_categoria'] + 1;
        }
        else
        {
            $codigo = 1;
        }
        RenderView::loadView('Categoria', 'cadastroCategoriaView', ['codigo' => $codigo]);
    }

    //Salva a categoria no Banco de dados
    public function create()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $cdCategoria = $_POST['cd_categoria'] ?? null;
            $nmCategoria = $_POST['nm_categoria'] ?? null;
            $dsCategoria = $_POST['ds_categoria'] ?? null;

            try
            {
                if(empty($nmCategoria))
                {
                    throw new Exception('O campo Nome é obrigatório!');
                }
                $this->categoria->setCdCategoria($cdCategoria);
                $this->categoria->setNmCategoria($nmCategoria);
                $this->categoria->setDsCategoria($dsCategoria);
                $this->categoria->create();
                header("Location: " . BASE_URL . "/categoria");
                exit();
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }
        RenderView::loadView('Categoria', 'cadastroCategoriaView', []);
    }
}