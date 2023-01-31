<?php

include_once '../src/model/CategoryModel.php';
function AdminCategoryDeleteController($twig, $db)
{
    $id = $_GET['category'] ?? null;

    if (deleteOneCategory($db, $id)) {
        header('location: /?page=adminCategoryList');
        die();
    }

    echo $twig->render('admin/message.html.twig', [
        'status' => 'danger',
        'message' => 'Erreur lors de la suppression de la catégorie.',
    ]);
}