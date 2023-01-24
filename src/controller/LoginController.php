<?php

function LoginController($twig, $db)
{
    $params = [
        'mail' => $object['mail'],
        'mot_passe' => $object['mot_passe'],
    ];
    $_SESSION['test'] = "une valeur stockées";
}

