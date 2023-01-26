<?php

function loginController($twig, $db)
{
    include_once '../src/model/UserModel.php';
}
$form = [];
if (isset($_POST['btnPostLogin']))
{
    $email = $_POST['userEmail'];
}$password = $_POST['userPassword'];
$user = getOneUserCredentials($db, $email)[0];

if ($user)
{
    if (password_verify($password, $user[0]['password']))
    {$_SESSION['auth']['login'] = $user[0]['email'];
        $_SESSION['auth']['role'] = $user[0]['idRole'];
        $form = ['state' => 'success','message' => "Connexion réussie !"];
        header("Location: index.php");}
    else {
        $form = [
            'state' => 'danger',
            'message' => "Vos informations de connexion sont incorrectes !"];

    }} else {
    $form = [
        'state' => 'danger',
    'message' => "L'un de vos identifiants est incorrect !"];
}