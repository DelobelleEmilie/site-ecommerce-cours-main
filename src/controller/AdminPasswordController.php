<?php

function AdminPasswordCOntroller($twig)
{
    if (isset($_POST['password1']) && isset($_POST['password2'])) {
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        if ($password1 === $password2) {
            // les mots de passe correspondent, procédez à la modification
        } else {
            echo "Les mots de passe ne correspondent pas. Veuillez réessayer.";
        }
    }
}
?>
