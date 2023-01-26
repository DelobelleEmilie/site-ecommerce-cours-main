<?php
function registerController($twig, $db)

{
    include_once '../src/model/UserModel.php';
}
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

}
