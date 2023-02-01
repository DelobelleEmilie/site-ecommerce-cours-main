<?php

include_once '../src/model/UserModel.php';

function ProfilController($twig, $db)
{
    $email = isset($_SESSION['auth']) ? $_SESSION['auth']['login'] : null;
    $ok = false;

    $status = null;
    $message = null;

    if ($email == null) {
        $status = "danger";
        $message = "Vous devez être connecté pour accéder à cette page.";
    } else {
        $credentials = getOneUserCredentials($db, $email);
        $id = count($credentials) > 0 ? $credentials[0]['id'] : null;
        if ($id != null) {
            $user = getOneUser($db, $id);
            $form = [
                'email' => $user['email'],
                'firstname' => $user['firstname'],
                'lastname' => $user['lastname'],
                'idRole' =>$user['idRole']
            ];
            $ok = true;

            if (!empty($_POST))
            {
                $email = htmlspecialchars($_POST['email']);
                $firstname = htmlspecialchars($_POST['firstname']);
                $lastname = htmlspecialchars($_POST['lastname']);

                $form = [
                    'email' => $email,
                    'firstname' => $firstname,
                    'lastname' => $lastname
                ];

                if (!isset($email) || strlen($email) < 3
                    || !isset($firstname) || strlen($firstname) < 3
                    || !isset($lastname)  || strlen($lastname) < 3
                )
                {
                    $status = 'danger';
                    $message = 'Vous devez renseigner tous les champs.';
                }
                else {
                    updateUser($db, $id, $email, $lastname, $firstname, $user['idRole']);

                    header('location: /?page=adminUserList');
                    die();
                }
            }

            echo $twig->render('admin/user/form.html.twig',
                [
                    'profile' => true,
                    'form' => $form
                ]
            );
        }
        else {
            $status = "danger";
            $message = "Utilisateur inconnu.";
        }
    }

    if (!$ok) {
        echo $twig->render('admin/umessage.html.twig',
            [
                'status' => $status,
                'message' => $message
            ]
        );
    }
}

//function deleteUser($db, $id)
//{
//    if (isset($_POST['delete_item'])) {
//        $query = $db->prepare("DELETE FROM shop_users WHERE id=:id");
//        $query->execute(['id' => $id]);
//        if ($query->rowCount() > 0) {
//            $result = true;
//        } else {
//            $result = false;
//        }
//        return $result;
//    }
//}
//
//function password()
//{
//    if (!empty($_POST)) {
//        ;
//        $password = $_POST['password'] ?? null;
//        $passwordConfirm = $_POST['new_mot_passe'] ?? null ;
//
//        $form['values'] = [
//            'new_mot_passe' => $passwordConfirm,
//    ];
//    }
//    if ($passwordConfirm === $passwordConfirm and $_POST["ancien_mot_passe"]  ==  $password   )
//    {
//        $form['state'] = 'sucess';
//    }
//    else
//    {
//        $form['state'] = 'danger';
//        $form['message'] = 'Les mots de passe ne correspondent pas ';
//    }
//    header("Location: /");
//    die();
//}