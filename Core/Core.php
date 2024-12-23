<?php

class Core 
{
    public function run($routes)
    {
        $url = '/';
        var_dump($routes);

        isset($_GET['url']) ? $url .= $_GET['url'] : '';

        foreach($routes as $path => $controller)
        {
            $pattern = '#^' . preg_replace('/{id}/', '(\w+)', $path). '$#';

            if(preg_match($pattern, $url, $matches))
            {
                array_shift($matches);

                [$currentController, $action] = explode('@', $controller);

                require_once __DIR__."/../App/Controllers/{$currentController}.php";
                
                $newController = new $currentController();
                $newController->$action();
            }
        }

    }
}