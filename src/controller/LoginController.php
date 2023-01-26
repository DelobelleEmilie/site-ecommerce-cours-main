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
if ($user) {
    if (password_verify($password, $user['password'])){$_SESSION['auth']['login'] = $user['email'];$_SESSION['auth']['role'] = $user['idRole'];$form = ['state' => 'success','message' => "Connexion réussie !"];
    }
    else {
        $form = [
            'state' => 'danger',
            'message' => "Vos informations de connexion sont incorrects !"];
    }}
else
{
    $form = ['state' => 'danger',
        'message' => "L'un de vos identifiants est incorrect !"];
}
echo $twig->render('login.html.twig',
    ['form' => $form]);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    if (empty($name) || empty($email)) {
        echo "Name and email must be filled out";
        exit;
    }
}
