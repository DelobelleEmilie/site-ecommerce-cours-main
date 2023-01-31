<?php

include_once '../src/model/CategoryModel.php';
function AdminCategoryListController($twig, $db)
{
    $categories = getallCategory($db);

    echo $twig->render('admin/category/list.html.twig', [
        'categories' => $categories,
    ]);
}