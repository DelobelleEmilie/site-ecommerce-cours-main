<?php

include_once '../src/model/UserModel.php';

function ProfileController($twig, $db)
{
    $auth = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;
    if (!isset($auth)) {
        header('location: /');
        die();
    }
    $id = isset($auth['id']) ? $auth['id'] : null;
    if (!isset($id)) {
        header('location: /');
        die();
    }

    $user = getOneUser($db, $id);

    $status = null;
    $message = null;

    $activetab = 'main';

    $form = [
        'email' => $user['email'],
        'firstname' => $user['firstname'],
        'lastname' => $user['lastname'],
        'idRole' => $user['idRole'],
        'active' => $user['active'] === 1
    ];

    if (!empty($_POST)) {
        $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : null;
        $firstname = isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : null;
        $lastname = isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : null;
        $oldpassword = isset($_POST['old-password']) ? htmlspecialchars($_POST['old-password']) : null;
        $newpassword = isset($_POST['new-password']) ? htmlspecialchars($_POST['new-password']) : null;
        $confirmpassword = isset($_POST['confirm-password']) ? htmlspecialchars($_POST['confirm-password']) : null;

        $form = [
            'email' => $email,
            'firstname' => $firstname,
            'lastname' => $lastname
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
                    var_dump($oldpassword, $newpassword);
                    $result = updateUserPasswordProfile($db, $id, $oldpassword, $newpassword);
                }
            }
        } else {
            if (!isset($email) || strlen($email) < 3
                || !isset($firstname) || strlen($firstname) < 3
                || !isset($lastname)  || strlen($lastname) < 3
            )
            {
                $status = 'danger';
                $message = 'Vous devez renseigner tous les champs.';
            }
            else {
                $result = updateUserProfile($db, $id, $email, $lastname, $firstname);
            }
        }

        if ($result) {
            header('location: /?page=adminUserList');
            die();
        }
        else {
            $status = $status ?? 'danger';
            $message = $message ?? 'Une erreur est survenue lors de la sauvegarde de l\'utilisateur.';
        }
    }

    echo $twig->render('admin/user/form.html.twig', [
        'form' => $form,
        'controller' => 'profile',
        'status' => $status,
        'message' => $message,
        'activeTab' => $activetab,
    ]);
}