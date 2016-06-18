<?php

class Bootstrap {

    function __construct()
    {
        $url = rtrim($_GET['url'], '/');
        $url = explode('/', $url);

        if (empty($url[0])){
            require 'controllers/error.php';
            $controller = new CError();
            $controller->index();
            return false;
        }

        $file = 'controllers/' . $url[0] . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            require 'controllers/error.php';
            $controller = new CError();
            $controller->index();
            return false;
        }

        $className = 'C' . $url[0];
        $controller = new $className;

        if (isset($url[2])){
            $controller->{$url[1]}($url[2]);
        } else{
            if (isset($url[1])) {
                $controller->{$url[1]}();
            }else {
                $controller->index();
            }
        }

    }
}
