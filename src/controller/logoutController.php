<?php

function logoutController($twig, $db)
{
    $_SESSION = [];
    session_destroy();
    header("Location: index.php");
}