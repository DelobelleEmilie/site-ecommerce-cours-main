<?php

include_once '../src/model/UserModel.php';
include_once '../src/model/RoleModel.php';
function AdminUserAddController($twig, $db)
{
    $roles = getAllRoles($db);

    $status = null;
    $message = null;

    $form = [
        'email' => '',
        'firstname' => '',
        'lastname' => '',
        'idRole' => ''
    ];

    if (!empty($_POST))
    {
        $email = htmlspecialchars($_POST['email']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $idRole = htmlspecialchars($_POST['idRole']);

        $form = [
            'email' => $email,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'idRole' => $idRole
        ];

        if (!isset($email) || strlen($email) < 3
            || !isset($firstname) || strlen($firstname) < 3
            || !isset($lastname)  || strlen($lastname) < 3
            || !isset($idRole)
        )
        {
            $status = 'danger';
            $message = 'Vous devez renseigner tous les champs.';
        }
        else {
            saveUser($db, $email, '', $lastname, $firstname, $idRole);

            header('location: /?page=adminUserList');
            die();
        }
    }

    echo $twig->render('admin/user/form.html.twig', [
        'form' => $form,
        'controller' => 'add',
        'roles' => $roles,
        'status' => $status,
        'message' => $message
    ]);
}