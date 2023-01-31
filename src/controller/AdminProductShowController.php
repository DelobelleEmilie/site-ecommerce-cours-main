<?php

include_once '../src/model/ProductModel.php';
include_once '../src/model/CategoryModel.php';
function AdminProductShowController($twig, $db)
{
    $id = $_GET['product'] ?? null;
    $product = getOneProduct($db, $id);

    $categories = getallCategory($db);

    $category_key = array_search(
    # permet d'accéder à l'idCategory du produit
        $product['idCategory'],
        # fabrique un tableau qui ne contient que les id
        array_column($categories, 'id')
    );

    $label = null;
    if ($category_key !== false) {
        $label = $categories[$category_key]['label'];
    }
    $product['category'] = $label;

    echo $twig->render('admin/product/show.html.twig', [
        'product' => $product,
    ]);
}