<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
include_once '../src/model/UserModel.php';

function profilController($db,$twig)
{


    if (isset($_POST['desactive']))
    {
        header('Location:index.php');
    }
    $email = null;
    $password = null;
    $passwordConfirm = null;
    $lastname = null;
    $firstname = null;

    $form = [
        'values' => [

            'lastname' => $lastname,
            'firstname' => $firstname,
        ]
    ];

    if (isset($_SESSION['auth'])) {
        header('Location:index.php');
    }


    if (!empty($_POST)) {

        $password = $_POST['password'] ?? null;
        $oldpassword = $_POST['oldpassword'] ?? null;
        $passwordnew1 = $_POST['newpassword'] ?? null;
        $passwordnew2 = $_POST['new2password'] ?? null;
        $lastname = $_POST['lastname'] ?? null;
        $firstname = $_POST['firstname'] ?? null;

        $form['values'] = [

            'lastname' => $lastname,
            'firstname' => $firstname,
        ];

        if (isset($firstname) && isset($lastname)) {
            if (count(getOneUserCredentials($db, $email)) === 0) {
                if ($password === $oldpassword and $passwordnew2 == $passwordnew1) {
                    saveUser($db, $passwordnew2, $lastname, $firstname, 1);
                    $form['state'] = 'success';
                    $form['message'] = 'Vous êtes avez modifier vos informations du compte!';
                }
                //Initialisation de la librairie
                $mail = new PHPMailer(true);
                $mail->CharSet = "UTF-8";

                $mail = new PHPMailer(true);  // Cree un nouvel objet PHPMailer
                $mail->CharSet = "UTF-8";

                $mail->IsSMTP(); // active SMTP
                $mail->SMTPDebug = SMTP::DEBUG_OFF;

                $mail->SMTPAuth = true;  // Authentification SMTP active
                $mail->SMTPSecure = 'ssl'; // Gmail REQUIERT Le transfert securise
                $mail->Host = 'smtp.mailosaur.net';
                $mail->Port = 465;
                $mail->Username = 'vjjsxfsc@mailosaur.net';
                $mail->Password = 'B4kE8P6JSsaKm4jO';

                $mail->setFrom('noreply@shop.fr', 'Shop');
                $mail->addAddress($email, $firstname . '' . $lastname);

                $mail->isHTML(true);
                $mail->Subject = 'Inscription à Shop';
                $mail->Body = $twig->render("/mail/modification_message.html.twig", [
                    'email' => $email
                ]);
                $mail->Send();
            }

            echo $twig->render('form.html.twig', ['form' => $form]);

        }
    }


}




