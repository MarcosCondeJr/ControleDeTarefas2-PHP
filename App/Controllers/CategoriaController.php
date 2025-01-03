<?php

namespace App\Controllers;
use App\Utils\RenderView;
use App\Config\Connection;
use App\Models\CategoriaModel;
use App\Service\CategoriaService;
use Exception;
use PDOException;

class CategoriaController
{
    private $messagem;
    private $db;
    private $categoria;
    private $service;

    public function __construct()
    {
        $this->db = (new Connection())->connect();
        $this->categoria = new CategoriaModel($this->db);
        $this->service = new CategoriaService($this->db);
    }

    public function index()
    {
        $categorias = $this->categoria->getAll();
        RenderView::loadView('Categoria', 'ListCategoriaView', ['categorias' => $categorias]);
    }

    public function createView()
    {
        //Gera um código automaticamente
        $categoria = $this->categoria->getLastCodigo();
        $codigo = RenderView::gerarCódigo($categoria, 'cd_categoria');
        
        RenderView::loadView('Categoria', 'cadastroCategoriaView', ['codigo' => $codigo]);
    }

    public function create()
    {
        $error = null;
        $sucesso = false;

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $cdCategoria = $_POST['cd_categoria'] ?? null;
            $nmCategoria = $_POST['nm_categoria'] ?? null;
            $dsCategoria = $_POST['ds_categoria'] ?? null;

            $data = [
                'cd_categoria' => $cdCategoria,
                'nm_categoria' => $nmCategoria,
                'ds_categoria' => $dsCategoria
            ];

            try
            {
                $this->service->create($data);
                $sucesso = true;
                RenderView::loadView('Categoria', 'cadastroCategoriaView', ['sucesso' => $sucesso]);
                exit();
            }
            catch (Exception $e)
            {
                $error = $e->getMessage();
            }
        }
        RenderView::loadView('Categoria', 'cadastroCategoriaView', ['error' => $error]);
    }

    public function delete()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $id = $_POST['id_categoria'];

            try
            {
                $this->categoria->delete($id);
                header("Location: " . BASE_URL . "/categoria");
                exit();
            }
            catch(PDOException $e)
            {
                throw new Exception('Erro ao deletar a categoria: ' . $e->getMessage());
            }
        }
    }

    public function updateView()
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $idCategoria = $_GET['id_categoria'];
            $categoria = $this->categoria->getById($idCategoria);
        }
        RenderView::loadView('Categoria', 'EditarCategoriaView', ['categoria' => $categoria]);
    }

    public function update()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $idCategoria = $_POST['id_categoria'] ?? null;
            $cdCategoria = $_POST['cd_categoria'] ?? null;
            $nmCategoria = $_POST['nm_categoria'] ?? null;
            $dsCategoria = $_POST['ds_categoria'] ?? null;

            $data = [
                'id_categoria' => $idCategoria,
                'cd_categoria' => $cdCategoria,
                'nm_categoria' => $nmCategoria,
                'ds_categoria' => $dsCategoria
            ];

            try
            {       
                $this->service->update($data);
                $sucesso = true;
                RenderView::loadView('Categoria', 'EditarCategoriaView', ['sucesso' => $sucesso]);
                exit();
            }
            catch (Exception $e)
            {
                $error = $e->getMessage();
            }
        }
        RenderView::loadView('Categoria', 'EditarCategoriaView', ['error' => $error]);
    }

    public function search()
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $filtro = $_GET['filtro'] ?? null;
            if($filtro != '')
            {
                $categorias = $this->categoria->search($filtro);
            }
            else 
            {
                $categorias = $this->categoria->getAll();
            }
        }
        RenderView::loadView('Categoria', 'ListCategoriaView', ['categorias' => $categorias]);
    }
}