<?php

include_once '../src/model/UserModel.php';

function registerController($twig, $db)
{

$form = [];
if (isset($_POST['btnPostRegister']))
{
    $email = $_POST['userEmail'];
}
    $password = $_POST['userPassword'];
    $passwordConfirm = $_POST['userPasswordConfirm'];
    $lastname = $_POST['userLastname'];
    $firstname = $_POST['userFirstname'];
    if (count(getOneUserCredentials($db, $email)) === 0)
    {
        if ($password === $passwordConfirm)
        {saveUser($db, $email, password_hash($password, PASSWORD_DEFAULT), $lastname, $firstname, 1);
            $form = ['state' => 'success','message' => "Vous êtes maintenant inscrit au site"];
        }
        else {
            $form = [
                'state' => 'danger',
                'message' => "Les deux mots de passe ne correspondent pas !"];
        }
}

else {$form = [
    'state' => 'danger',
    'message' => "Un compte avec cette adresse mail existe déjà !"];

}
echo $twig->render('register.html.twig', ['form' => $form]);

if (empty($_POST['username'])) {
    echo "Le champ nom d'utilisateur est vide.";
}

if (empty($_POST['password'])) {
    echo "Le champ mot de passe est vide.";
}

if (strlen($_POST['password']) < 3) {
    echo "Le mot de passe doit avoir au moins 3 caractères.";
}

}
