<?php

namespace App\Controllers;
use App\Utils\RenderView;

class CategoriaController
{
    public function index()
    {
        RenderView::loadView('Categoria', 'ListCategoriaView', []);
    }
    public function createView()
    {
        RenderView::loadView('Categoria', 'cadastroCategoriaView', []);
    }
}