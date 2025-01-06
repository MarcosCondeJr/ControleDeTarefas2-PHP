<?php

namespace App\Controllers;
use App\Utils\RenderView;

class HomeController
{
    public function index()
    {
        RenderView::loadView('Home','HomePage', []);
    }

    public function LoginView()
    {
        RenderView::loadView('Login','LoginPage', []);
    }

    public function login()
    {
        
    }
}