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
        'idRole' => '',
        'active' => true
    ];

    if (!empty($_POST))
    {
        $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : null;
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $idRole = htmlspecialchars($_POST['idRole']);
//        pour lire depuis le formulaire
        $active = isset($_POST['active']) ? htmlspecialchars($_POST['active']) === "1" : null;
        $newpassword = isset($_POST['new-password']) ? htmlspecialchars($_POST['new-password']) : null;
        $confirmpassword = isset($_POST['confirm-password']) ? htmlspecialchars($_POST['confirm-password']) : null;

        $form = [
            'email' => $email,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'idRole' => $idRole,
            'active' => $active
        ];

        if (!isset($email) || strlen($email) < 3
            || !isset($firstname) || strlen($firstname) < 3
            || !isset($lastname)  || strlen($lastname) < 3
            || !isset($idRole)
            || !isset($newpassword) || strlen($newpassword) < 3
            || !isset($confirmpassword) || strlen($confirmpassword) < 3
            || $newpassword !== $confirmpassword
        )
        {
            $status = 'danger';
            $message = 'Vous devez renseigner tous les champs.';
        }
        else {
            saveUser($db, $email, $newpassword, $lastname, $firstname, $idRole, $active);

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