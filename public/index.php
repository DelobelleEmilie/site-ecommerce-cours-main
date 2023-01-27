<?php

require_once '../vendor/autoload.php';
require_once '../config/routes.php';
require_once '../src/router.php';
require_once '../src/twig.php';
require_once '../config/config.php';
require_once '../src/database.php';

session_start();


$twig = initTwig('../template');
$db = getConnection($config);

if (gettype($db) == "string") {
  echo $twig->render('error.html.twig', ['message' => 'Notre site est actuellement indisponible, revenez dans quelques minutes.']);
  die();
}

$actionController = initRouter($routes);
$actionController($twig, $db);

