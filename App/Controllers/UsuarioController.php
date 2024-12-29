<?php

namespace App\Controllers;
use App\Utils\RenderView;
use App\Config\Connection;
use Exception;

class UsuarioController 
{
    private $user;
    private $db;

    public function __construct()
    {
        $this->db = (new Connection())->connect();
        
    }

    public function index()
    {
        RenderView::loadView('Usuario', 'ListUsuarioView', []);
    }

    public function createView()
    {
        RenderView::loadView('Usuario', 'CadastroUsuarioView', []);
    }
}