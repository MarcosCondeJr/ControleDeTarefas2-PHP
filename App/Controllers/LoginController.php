<?php

namespace App\Controllers;
use App\Utils\RenderView;
use App\Service\LoginService;
use App\Config\Connection;
use Exception;
use PDO;

class LoginController
{
    private $db;
    private $service;

    public function __construct()
    {
        $this->db = (new Connection())->connect();
        $this->service = new LoginService($this->db);
    }

    public function index()
    {
        RenderView::loadView('Home','HomePage', []);
    }

    public function LoginView()
    {
        RenderView::loadLogin('Login','LoginPage');
    }

    public function login()
    {
        $error = null;

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            try
            {
                $object = json_decode(json_encode($_POST));
                $this->service->login($object);

                self::index();
            }
            catch(Exception $e)
            {
                $error = $e->getMessage();
            }
        }
        RenderView::loadLogin('Login', 'LoginPage', ['error' => $error]);
    }

    public function logOut()
    {
        RenderView::loadLogin('Login','LoginPage');
    }
}