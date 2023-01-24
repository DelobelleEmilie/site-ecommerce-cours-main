<?php

function RegisterController($twig, $db)
{
    $params = [
        'mail' => $object['mail'],
        'date_naissance' => $object['date_naissance'],
        'prenom' => $object['prénom'],
        'nom' => $object['nom'],
        'mot_passe' => $object['mot_passe'],
        'telephone' => $object['télephone']
    ];
    $_SESSION['test'] = "une valeur stockées";
}

