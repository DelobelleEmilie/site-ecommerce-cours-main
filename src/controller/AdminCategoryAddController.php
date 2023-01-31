<?php

include_once '../src/model/CategoryModel.php';
function AdminCategoryAddController($twig, $db)
{
    $status = null;
    $message = null;

    $form = [
        'label' => ''
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
            saveCategory($db, $label);

            header('location: /?page=adminCategoryList');
            die();
        }
    }

    echo $twig->render('admin/category/form.html.twig', [
        'form' => $form,
        'controller' => 'add',
        'status' => $status,
        'message' => $message
    ]);
}