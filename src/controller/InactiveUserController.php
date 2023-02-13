<?php

include_once '../src/model/UserModel.php';

function InactiveUserController($twig, $db)
{
    $auth = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;
    if (!isset($auth)) {
        header('location: /');
        die();
    }
    $id = isset($auth['id']) ? $auth['id'] : null;
    if (!isset($id)) {
        header('location: /');
        die();
    }

    setUserActive($db, $id, false);

    header('location: /?page=logout');
    die();
}