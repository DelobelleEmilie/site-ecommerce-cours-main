<?php
#implante le fichier ProductModel
include_once '../src/model/ProductModel.php';
include_once '../src/model/CategoryModel.php';

$categories = getAllCategories();


#Si on saisis le formulaire $_POST contient les données ducoup les produit s'enregistre et raffiche le formulaire vide
function addProductController($twig, $db)
{
  include_once '../src/model/ProductModel.php';
  #Une variable «$form» est créée et définie en tant que tableau vide «[]»
  $form = [];
  if (isset($_POST['btnAddProduct'])) {
    $label = htmlspecialchars($_POST['productLabel']);
    $description = htmlspecialchars($_POST['productDescription']);
    $price = htmlspecialchars($_POST['productPrice']);
    if (empty($price)) {
      $price = 0.00;
    }
    $category = htmlspecialchars($_POST['productCategory']);

      if (empty($label) || empty($description) || empty($category)) {
          #la variable «$form» se constitue d’une clé «state» pour définir l’état du formulaire.
          #Le tableau est aussi constitué d’une clé «message» danslaquelle nous renseignerons un message personnalisé pour informer l’utilisateur
          $form = [
              'state' => 'danger',
              'message' => 'Votre produit n\'a pas été ajouté car les champs obligatoires n\'ont pas été remplis !'
          ];
          #la variable «$form» est complétéeavec des informations que nous pourrons réutiliser dans la vue Twig.
          echo $twig->render('form_addproduct.html.twig', [
              #la variable «$form» est passée à lavue Twig sous le nom «form»
              'form' => $form
          ]);
#sinon le produit est sauvergardée
      } else {
          [
              saveProduct($db, $label, $description, $price, $category)
          ];
          #la variable «$form» est complétéeavec des informations que nous pourrons réutiliser dans la vue Twig.
          echo $twig->render('form_addproduct.html.twig', [
              'form' => $form

          ]);
      }

    }
}
