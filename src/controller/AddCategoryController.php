<?php

require_once '../src/model/categorymodel';

function addCategoryController($twig, $db)
{
    include_once '../src/model/CategoryModel.php';
    $form = [];
    if (isset($_POST['btnAddCategory'])) {
        $label = htmlspecialchars($_POST['CategoryLabel']);
        $description = htmlspecialchars($_POST['CategoryDescription']);
        $category = htmlspecialchars($_POST['CategoryParent']);
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
    if (isset($_POST['btnDeleteCategory'])) {
        $id = $_POST['CategoryId'];
        if (!empty($id)) {
            deleteCategory($db, $id);
            $form = [
                'state' => 'success',
                'message' => 'Votre catégorie a bien été supprimée !'
            ];
        } else {
            $form = ['state' => 'danger', 'message' => 'La suppression de la catégorie a échouée !'];
            echo $twig->render('form_category.html.twig', [
                'form' => $form
            ]);
        }
    }
}
