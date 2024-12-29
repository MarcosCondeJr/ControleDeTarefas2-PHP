<?php

namespace App\Controllers;
use App\Utils\RenderView;
use App\Config\Connection;
use App\Models\CategoriaModel;
use Exception;

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
        $error = null;
        $sucesso = false;

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $cdCategoria = $_POST['cd_categoria'] ?? null;
            $nmCategoria = $_POST['nm_categoria'] ?? null;
            $dsCategoria = $_POST['ds_categoria'] ?? null;

            $categoria = $this->categoria->getAll();

            try
            {
                //Verifica se não existe uma categoria com o mesmo código
                foreach($categoria as $cat)
                {
                    if($cat['cd_categoria'] == $cdCategoria)
                    {
                        throw new Exception("Já existe uma categoria com o código $cdCategoria");
                    }
                }
                    
                if(empty(trim($nmCategoria)))
                {
                    throw new Exception('O Campo Nome é obrigatório!');
                }

                $this->categoria->setCdCategoria($cdCategoria);
                $this->categoria->setNmCategoria($nmCategoria);
                $this->categoria->setDsCategoria($dsCategoria);

                //Cria a categoria
                $this->categoria->create();

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

            try
            {       
                if(empty(trim($nmCategoria)))
                {
                    throw new Exception('O Campo Nome é obrigatório!');
                }

                $this->categoria->setIdCategoria($idCategoria);
                $this->categoria->setCdCategoria($cdCategoria);
                $this->categoria->setNmCategoria($nmCategoria);
                $this->categoria->setDsCategoria($dsCategoria);

                //Atualiza a categoria
                $this->categoria->update();

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
}