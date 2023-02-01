<?php


function initRouter($routes)
{
    //Si la variable page existe donc dans l'url on a mis ?page=truc alors $page devient ?page
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 'home';
    }


    //Si page est dans le tableau des routes alors $route devient la route (homeController)
    if (isset($routes[$page])) {
        $route = $routes[$page];

    //Si la page n'est pas dans le tableau des routes alors $route afficher la page d'erreur
    } else {
        $route = $routes['error'];
    }

    $arguments = explode(":", $route);
    $controller = ucfirst($arguments[0]);
    $access =  count($arguments) > 1 ? explode(",", $arguments[1]) : [2]; // admin seulement par défaut

    if (!in_array('0', $access)) {
        if (!isset($_SESSION['auth']) || !in_array($_SESSION['auth']['role'], $access)) {
            $controller = "HomeController";
        }
    }

    //Require le fichier controller - ex : controller/HomeController.php
    require_once 'controller/' . $controller . '.php';

    return $controller;
}


 