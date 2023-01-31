<?php

include_once '../src/model/UserModel.php';
include_once '../src/model/RoleModel.php';
function AdminUserShowController($twig, $db)
{
    $id = $_GET['user'] ?? null;
    $user = getOneUser($db, $id);

    $roles = getAllRoles($db);

    $role_key = array_search(
    # permet d'accéder à l'idCategory du produit
        $user['idRole'],
        # fabrique un tableau qui ne contient que les id
        array_column($roles, 'id')
    );

    $label = null;
    if ($role_key !== false) {
        $label = $roles[$role_key]['label'];
    }
    $user['role'] = $label;

    echo $twig->render('admin/user/show.html.twig', [
        'user' => $user,
    ]);
}