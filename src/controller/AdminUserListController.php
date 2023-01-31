<?php

include_once '../src/model/UserModel.php';
include_once '../src/model/RoleModel.php';
function AdminUserListController($twig, $db)
{
    $users = getAllUsers($db);
    $roles = getAllRoles($db);

    $users = array_map(
        function ($user) use ($roles) {
            #Index du tableau
            $user_key = array_search(
            # permet d'accéder à l'idCategory du produit
                $user['idRole'],
                # fabrique un tableau qui ne contient que les id
                array_column($roles, 'id')
            );
            #ajouter categorie a produit
            $label = null;
            if ($user_key !== false) {
                $label = $roles[$user_key]['label'];
            }
            $user['role'] = $label;
            return $user;
        },
        $users);

    echo $twig->render('admin/user/list.html.twig', [
        'users' => $users,
    ]);
}