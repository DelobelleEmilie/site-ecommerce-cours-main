<?php


function initRouter($routes)
{
          //Si la variable page existe donc dans l'url on a mis ?page=truc alors $page devient ?page
        if (isset($_GET['page']))
        {
                $page = $_GET['page'];
        } else
        {
                $page = 'home';
        }



//Si page est dans le tableau des routes alors $route devient la route (homeController)
        if (isset($routes[$page])) 
        {
                $route = $routes[$page];
                
    //Si la page n'est pas dans le tableau des routes alors $route afficher la page d'erreur 
        } else 
        {
                $route = $routes['error'];
        }
        $controller = ucfirst($route);
    //Require le fichier controller HomeController.php
        require_once 'controller/' .$controller.'.php';

        return $controller;
}


 