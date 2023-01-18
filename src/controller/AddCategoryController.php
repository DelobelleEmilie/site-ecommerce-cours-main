<?php

include_once '../src/model/CategoryModel.php';

function addCategoryController($twig, $db)
{
    include_once '../src/model/CategoryModel.php';
    $form = [];
    if (isset($_POST['btnAddCategory'])) {
        $label = htmlspecialchars($_POST['CategoryLabel']);
        if (!empty($label) && !empty($description) && !empty($category)) {
            $form = [
                'state' => 'success',
                'message' => 'Votre catégorie a bien été ajoutée !'
            ];
            saveProduct($db, $label,$category);
        } else {
            $form = ['state' => 'danger', 'message' => 'Votre Category n\'a pas été ajouté car les champs obligatoires n\'ont pas été remplis !'];
            echo $twig->render('form_category.html.twig', [
                'form' => $form
            ]);
        }
    }
}