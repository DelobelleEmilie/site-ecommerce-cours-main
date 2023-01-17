<?php 
include_once '../src/model/ProductModel.php';

function homeController($twig, $db)
{
$products=getAllProduct($db);

  echo $twig->render('home.html.twig', [
      'products' => $products
  ]);
}

?> 

