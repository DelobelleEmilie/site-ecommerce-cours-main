<?php

include_once '../src/model/UserModel.php';
include_once '../src/model/RoleModel.php';
function AdminUserEditController($twig, $db)
{
    $id = $_GET['user'] ?? null;

    $user = getOneUser($db, $id);
    $roles = getAllRoles($db);
//    pour revenir dans le bon onglet à lors de la mise à jour
    $activetab = 'main';

    $status = null;
    $message = null;

    $form = [
        'email' => $user['email'],
        'firstname' => $user['firstname'],
        'lastname' => $user['lastname'],
        'idRole' => $user['idRole'],
        'active' => $user['active'] === 1
    ];

    if (!empty($_POST))
    {
        $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : null;
        $firstname = isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : null;
        $lastname = isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : null;
        $idRole = isset($_POST['idRole']) ? htmlspecialchars($_POST['idRole']) : null;
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

        $result = false;

        if ($newpassword !== null) {
            $activetab = 'password';
            if (!isset($newpassword) || strlen($newpassword) < 3
                || !isset($confirmpassword)  || strlen($confirmpassword) < 3
            )
            {
                $status = 'danger';
                $message = 'Vous devez renseigner tous les champs.';
            } else {
                if ($confirmpassword !== $newpassword) {
                    $status = 'danger';
                    $message = 'Le mot de passe et sa confirmation doivent être identiques.';
                }
                else {
                    $result = updateUserPassword($db, $id, $newpassword);
                }
            }
        } else {
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
                $result = updateUser($db, $id, $email, $lastname, $firstname, $idRole, $active);
            }
        }

        if ($result) {
            header('location: /?page=adminUserList');
            die();
        }
        else {
            $status = isset($status) ?? 'danger';
            $message = isset($message) ?? 'Une erreur est survenue lors de la sauvegarde de l\'utilisateur.';
        }
    }

    echo $twig->render('admin/user/form.html.twig', [
        'form' => $form,
        'controller' => 'edit',
        'roles' => $roles,
        'status' => $status,
        'message' => $message,
        'activeTab' => $activetab,
    ]);
}