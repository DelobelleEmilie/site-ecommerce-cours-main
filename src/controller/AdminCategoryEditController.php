<?php

include_once '../src/model/CategoryModel.php';
function AdminCategoryEditController($twig, $db)
{
    $id = $_GET['category'] ?? null;

    $product = getOneCategory($db, $id);

    $status = null;
    $message = null;

    $form = [
        'label' => $product['label']
    ];

    if (!empty($_POST))
    {
        $label = htmlspecialchars($_POST['label']);

        $form = [
            'label' => $label
        ];

        if (!isset($label) || strlen($label) < 3)
        {
            $status = 'danger';
            $message = 'Vous devez renseigner tous les champs.';
        }
        else {
            updateOneCategory($db, $id, $label);

            header('location: /?page=adminCategoryList');
            die();
        }
    }

    echo $twig->render('admin/category/form.html.twig', [
        'form' => $form,
        'controller' => 'edit',
        'status' => $status,
        'message' => $message
    ]);
}