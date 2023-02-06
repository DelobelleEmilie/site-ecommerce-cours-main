<?php

include_once '../src/model/UserModel.php';

function loginController($twig, $db)
{
    $email = null;
    $password = null;

    $form = [
        'values' => [
            'email' => $email
        ]
    ];

    if (isset($_SESSION['auth']))
    {
        header('Location:index.php');
    }

    if (!empty($_POST)) {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        $form['values'] = [
            'email' => $email
        ];

        if (isset($email) && strlen($email) > 0 && isset($password)) {

            $user = getOneUserCredentials($db, $email)[0];

            if ($user) {

                if (password_verify($password, $user['password'])) {
                    $_SESSION['auth']['id'] = $user['id'];
                    $_SESSION['auth']['login'] = $user['email'];
                    $_SESSION['auth']['role'] = $user['idRole'];
                    header("Location: /");
                    die();
                } else {
                    $form['state'] = 'danger';
                    $form['message'] = 'Identifiants incorrects.';
                }
            } else {
                $form['state'] = 'danger';
                $form['message'] = 'Identifiants incorrects.';
            }
        }
        else {
            $form['state'] = 'danger';
            $form['message'] = 'Tous les champs obligatoires ne sont pas renseignés.';
        }
    }

    echo $twig->render('login.html.twig', ['form' => $form]);


}