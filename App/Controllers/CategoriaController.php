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
        RenderView::loadView('Categoria', 'ListCategoriaView', []);
    }

    public function createView()
    {
        RenderView::loadView('Categoria', 'cadastroCategoriaView', []);
    }

    public function create()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            session_start();
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
                session_destroy();
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }
        RenderView::loadView('Categoria', 'ListCategoriaView', []);
    }
}