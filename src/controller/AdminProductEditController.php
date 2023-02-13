<?php

include_once '../src/model/ProductModel.php';
include_once '../src/model/CategoryModel.php';
include_once '../src/service/upload.php';

function AdminProductEditController($twig, $db)
{
    $id = $_GET['product'] ?? null;

    $product = getOneProduct($db, $id);
    $categories = getallCategory($db);

    $status = null;
    $message = null;

    $file_path = null;

    $form = [
        'label' => $product['label'],
        'description' => $product['description'],
        'price' => $product['price'],
        'idCategory' => $product['idCategory']
    ];

    if (!empty($_POST))
    {
        $label = htmlspecialchars($_POST['label']);
        $description = htmlspecialchars($_POST['description']);
        $price = htmlspecialchars($_POST['price']);
        $idCategory = htmlspecialchars($_POST['idCategory']);

        $form = [
            'label' => $label,
            'description' => $description,
            'price' => $price,
            'idCategory' => $idCategory
        ];

        if (!isset($label) || strlen($label) < 3
            || !isset($description) || strlen($description) < 3
            || !isset($price) || !isset($idCategory)
        )
        {
            $status = 'danger';
            $message = 'Vous devez renseigner tous les champs.';
        }
        else {
            if (isset($_FILES["image"])) {
                $file_path = upload($_FILES["image"]);
            }

            updateOneProduct($db, $id, $label, $description, $price, $idCategory, $file_path);

            header('location: /?page=adminProductList');
            die();
        }
    }

    echo $twig->render('admin/product/form.html.twig', [
        'form' => $form,
        'controller' => 'edit',
        'categories' => $categories,
        'status' => $status,
        'message' => $message
    ]);
}