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
//    décompose la chaîne $route en un tableau $arguments en utilisant le caractère ":" comme séparateur.
        $arguments = explode(":", $route);
//    La variable $controller est définie en utilisant le premier élément du tableau $arguments
//    et en le mettant en majuscules pour la première lettre.
//Cela définit le nom du contrôleur à utiliser pour cette route.

    $controller = ucfirst($arguments[0]);
    //    La variable $access est définie en vérifiant le nombre d'éléments dans $arguments et
//     en utilisant le deuxième élément (s'il existe) comme une liste de rôles
//    d'utilisateur autorisés pour cette route,
//    décomposés en utilisant la virgule comme séparateur. S
//    i le nombre d'arguments est inférieur à 2, la variable
//    $access est définie sur une liste contenant la valeur 2 par défaut,
//    ce qui signifie que seuls les utilisateurs ayant un rôle d'administrateur peuvent accéder à cette route.
    $access =  count($arguments) > 1 ? explode(",", $arguments[1]) : [2]; // admin seulement par défaut

//    Enfin, le code vérifie si la valeur 0 n'est pas présente dans la liste $access.
//    Si ce n'est pas le cas, il vérifie si une session utilisateur est en cours
//($_SESSION['auth']) et si le rôle de l'utilisateur actuel ($_SESSION['auth']['role'])
//est présent dans la liste $access. Si l'une de ces conditions n'est pas remplie,
//le nom du contrôleur est défini sur "HomeController".
    if (!in_array('0', $access)) {
        if (!isset($_SESSION['auth']) || !in_array($_SESSION['auth']['role'], $access)) {
            $controller = "HomeController";
        }
    }
    //Require le fichier controller HomeController.php
        require_once 'controller/' .$controller.'.php';

        return $controller;
}


 