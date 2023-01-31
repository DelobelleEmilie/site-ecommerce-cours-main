<?php

include_once '../src/model/ProductModel.php';
include_once '../src/model/CategoryModel.php';
function showProductByCategoryController($twig, $db)
{
    $categoryId = $_GET['category'] ?? null;
    $products = getAllProductByCategory($db, $categoryId);
    $categories = getallCategory($db);
    $category = null;

    foreach ($categories as $c) {
        if ($c['id'] == $categoryId) {
            $category = $c;
            break;
        }
    }

    echo $twig->render('show_product_by_category.html.twig', [
        'products' => $products,
        'category' => $category,
        'categories' => $categories
    ]);
}