<?php
#
function updateProductController($twig, $db) {
    include_once '../src/model/ProductModel.php';
    if (isset($_GET['product'])) {$product = getOneProduct($db, $_GET['product']);
        if (isset($_POST['btnPostProduct'])) {$label = $_POST['productLabel'];
            $description = $_POST['productDescription'];
            $price = $_POST['productPrice'];
            if(empty($price)) {$price = 0.00;
            }$category = $_POST['productCategory'];
            if (!empty($label) && !empty($description) && !empty($category))
            {updateOneProduct($db,$product['id'], $label, $description, $price, $category);
            }}
        echo $twig->render('form_product.html.twig', ['product' => $product,'page' => '?page=updateProduct&product='.$product['id']]);
    } else {echo $twig->render('home.html.twig', []);
    }}