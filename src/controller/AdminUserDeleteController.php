<?php

include_once '../src/model/UserModel.php';
function AdminUserDeleteController($twig, $db)
{
    $id = $_GET['user'] ?? null;

    if (deleteUser($db, $id)) {
        header('location: /?page=adminUserList');
        die();
    }

    echo $twig->render('admin/message.html.twig', [
        'status' => 'danger',
        'message' => 'Erreur lors de la suppression de l\'utilisateur.',
    ]);
}