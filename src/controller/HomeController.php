<?php 
include_once '../src/model/ProductModel.php';

function homeController($twig, $db)
{
$products=getAllProduct($db);

var_dump($products);
  echo $twig->render('home.html.twig', []);
}

?> 

