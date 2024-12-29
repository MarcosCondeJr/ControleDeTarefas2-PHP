<?php

namespace App\Controllers;
use App\Utils\RenderView;
use App\Config\Connection;
use Exception;

class UserController 
{
    private $user;
    private $db;

    public function __construct()
    {
        $this->db = (new Connection())->connect();
        
    }

    public function index()
    {
        RenderView::loadView('User', 'ListUserView', []);
    }

    public function createView()
    {
        RenderView::loadView('User', 'CadastroUserView', []);
    }
}