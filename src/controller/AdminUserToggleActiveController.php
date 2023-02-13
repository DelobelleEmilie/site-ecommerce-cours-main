<?php

include_once '../src/model/UserModel.php';
function AdminUserToggleActiveController($twig, $db)
{
    $id = $_GET['user'] ?? null;

    $user = getOneUser($db, $id);

    if (setUserActive($db, $id, $user['active'] === 0)) {
        header('location: /?page=adminUserList');
        die();
    }

    echo $twig->render('admin/message.html.twig', [
        'status' => 'danger',
        'message' => 'Erreur lors de la suppression de l\'utilisateur.',
    ]);
}