<?php
include_once '../src/model/ProductModel.php';
include_once '../src/model/CategoryModel.php';

function homeController($twig, $db)
{
    $products = getAllProduct($db);
    $categories = getallCategory($db);

    $products = array_map(
        function ($product) use ($categories) {
            #Index du tableau
            $category_key = array_search(
                # permet d'accéder à l'idCategory du produit
                $product['idCategory'],
                # fabrique un tableau qui ne contient que les id
                array_column($categories, 'id')
            );
            #ajouter categorie a produit
            $label = null;
            if ($category_key !== false) {
                $label = $categories[$category_key]['label'];
            }
            $product['category'] = $label;
            return $product;
        },
        $products);


    echo $twig->render('home.html.twig', [
        'products' => $products,
        'categories' => $categories
    ]);
}

