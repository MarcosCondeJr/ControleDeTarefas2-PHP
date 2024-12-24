<?php

namespace App\Controllers;
use App\Utils\RenderView;

class HomeController
{
    public function index()
    {
        RenderView::loadView('HomePage', []);
    }
}