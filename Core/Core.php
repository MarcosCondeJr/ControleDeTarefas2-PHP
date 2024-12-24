<?php

use App\Controllers\NotFoundController;

class Core 
{
    public function run($routes)
    {
        $url = '/';

        isset($_GET['url']) ? $url .= $_GET['url'] : '';

        //Remove a outra barra passada na url
        ($url != '/') ? $url = rtrim($url, '/') : $url;

        $routerFound = false;

        foreach($routes as $path => $controller)
        {
            $pattern = '#^' . preg_replace('/{id}/', '([a-zA-Z0-9-_?]+)', $path) . '$#';

            if(preg_match($pattern, $url, $matches))
            {
                array_shift($matches);

                $routerFound = true;

                [$currentController, $action] = explode('@', $controller);
                $qualifiedController = "App\\Controllers\\{$currentController}";
                
                //Estancia o controller
                $newController = new $qualifiedController();
                $newController->$action($matches);
            }
        }

        if(!$routerFound)
        {
            $controller = new NotFoundController();
            $controller->index();
        }
    }
}