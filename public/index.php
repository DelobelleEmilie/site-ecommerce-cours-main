<?php

require_once '../vendor/autoload.php';

use src\router;
use src\twig;
use src\config;
use src\database;

session_start();

$config = require_once '../config/config.php';
$routes = require_once '../config/routes.php';

$twig = twig::initTwig('../template');
$db = database::getConnection($config);

if (gettype($db) == "string") {
    echo $twig->render('error.html.twig', ['message' => 'Notre site est actuellement indisponible, revenez dans quelques minutes.']);
    die();
}

$actionController = router::initRouter($routes);
$actionController($twig, $db);
