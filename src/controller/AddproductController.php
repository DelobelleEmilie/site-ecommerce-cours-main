<?php
#implante le fichier ProductModel
include_once '../src/model/ProductModel.php';


#Si on saisis le formulaire $_POST contient les données ducoup les produit s'enregistre et raffiche le formulaire vide

function addProductController($twig, $db)
{
  include_once '../src/model/ProductModel.php';
  $form = [];
  if (isset($_POST['btnAddProduct'])) {
    $label = htmlspecialchars($_POST['productLabel']);
    $description = htmlspecialchars($_POST['productDescription']);
    $price = htmlspecialchars($_POST['productPrice']);
    if (empty($price)) {
      $price = 0.00;
    }
    $category = htmlspecialchars($_POST['productCategory']);

    if (!empty($label) && !empty($description) && !empty($category)) {
      $form = [
          'state' => 'success',
          'message' => 'Votre produit a bien été ajouté !'
      ];
      saveProduct($db, $label, $description, $price, $category);
    } else {
      $form = ['state' => 'danger', 'message' => 'Votre produit n\'a pas été ajouté car les champs obligatoires n\'ontpas été remplis !'];

      echo $twig->render('form_product.html.twig', [
          'form' => $form
      ]);

    }
  }
}
function Modification ($db,$twig,$form)
{
    if (isset($_POST['btnPostProduct']))
        echo $twig->render('form_product.html.twig', ['form' => $form, 'page' => '?page=addProduct']);
}