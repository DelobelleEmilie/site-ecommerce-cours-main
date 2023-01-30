<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

include_once '../src/model/UserModel.php';

function registerController($twig, $db)
{

    $email = null;
    $password = null;
    $passwordConfirm = null;
    $lastname = null;
    $firstname = null;

    $form = [
        'values' => [
            'email' => $email,
            'lastname' => $lastname,
            'firstname' => $firstname,
        ]
    ];

    if (!empty($_POST)) {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        $passwordConfirm = $_POST['passwordConfirm'] ?? null;
        $lastname = $_POST['lastname'] ?? null;
        $firstname = $_POST['firstname'] ?? null;

        $form['values'] = [
            'email' => $email,
            'lastname' => $lastname,
            'firstname' => $firstname,
        ];

        if (isset($email) && strlen($email) > 0 && isset($firstname) && isset($lastname)) {
            if (count(getOneUserCredentials($db, $email)) === 0) {
                if ($password === $passwordConfirm) {
                    saveUser($db, $email, password_hash($password, PASSWORD_DEFAULT), $lastname, $firstname, 1);
                    $form['state'] = 'success';
                    $form['message'] = 'Vous êtes maintenant inscrit au site !';

                    //Initialisation de la librairie
                    $mail = new PHPMailer(true);
                    $mail->CharSet = "UTF-8";

                    $mail = new PHPMailer(true);  // Cree un nouvel objet PHPMailer
                    $mail->CharSet = "UTF-8";

                    $mail->IsSMTP(); // active SMTP
                    $mail->SMTPDebug = SMTP::DEBUG_OFF;

                    $mail->SMTPAuth = true;  // Authentification SMTP active
                    $mail->SMTPSecure = 'ssl'; // Gmail REQUIERT Le transfert securise
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = 465;
                    $mail->Username = 'noreplyprojetshop@gmail.com';
                    $mail->Password = 'xP;z33T]%E1UJ[[+';

                    $mail->setFrom('noreply@shop.fr', 'Shop');
                    $mail->addAddress($email, $firstname . '' . $lastname);

                    $mail->isHTML(true);
                    $mail->Subject = 'Inscription à Shop';
                    $mail->Body = $twig->render("/mail/register_message.html.twig", [
                        'email' => $email
                    ]);

                    $mail->Send();

                } else {
                    $form['state'] = 'danger';
                    $form['message'] = 'Les deux mots de passe ne correspondent pas !';
                }
            } else {
                $form['state'] = 'danger';
                $form['message'] = 'Un compte avec cette adresse mail existe déjà !';

            }
        } else {
            $form['state'] = 'danger';
            $form['message'] = 'Tous les champs obligatoires ne sont pas renseignés.';
        }


    }

    echo $twig->render('register.html.twig', ['form' => $form]);

}
