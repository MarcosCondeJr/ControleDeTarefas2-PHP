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
            $object = json_decode(json_encode($_POST));

            try
            {
                $this->service->create($object);
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
        $error = null;

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $id = $_POST['id_categoria'];
            $categoria = $this->categoria->getById($id);

            try
            {
                $this->categoria->delete($id);
                header("Location: " . BASE_URL . "/categoria");
                exit();
            }
            catch(PDOException $e)
            {
                $error = "Não é possivel deletar a categoria ". $categoria['nm_categoria'] . " pois ela está vinculada a uma tarefa!";
            }
        }
        $categorias = $this->categoria->getAll();
        RenderView::loadView('Categoria', 'ListCategoriaView', [
            'categorias' => $categorias,
            'error' => $error
        ]);
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
            $object = json_decode(json_encode($_POST));

            try
            {       
                $this->service->update($object);
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