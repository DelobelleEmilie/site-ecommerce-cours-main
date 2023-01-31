<?php

include_once '../src/model/ProductModel.php';
function AdminProductDeleteController($twig, $db)
{
    $id = $_GET['product'] ?? null;

    if (deleteOneProduct($db, $id)) {
        header('location: /?page=adminProductList');
        die();
    }

    echo $twig->render('admin/message.html.twig', [
        'status' => 'danger',
        'message' => 'Erreur lors de la suppression du produit.',
    ]);
}