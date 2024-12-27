<?php

namespace App\Controllers;
use App\Utils\RenderView;

class CategoriaController
{
    public function createView()
    {
        RenderView::loadView('Categoria', 'cadastroCategoriaView', []);
    }
}