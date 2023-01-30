<?php

function getOneUserCredentials($db, $email) {
    // Recupère les utilisateurs de la base de données d'après l'adresse email
    $query = $db->prepare(
        "SELECT id,email,password,idRole FROM shop_users WHERE email = :email"
    );
    $query->execute([
        'email' => $email
    ]);
    return $query->fetchAll();
}

function saveUser($db, $email, $password, $lastname, $firstname, $idRole) {
    // Récupération des données de l'utilisateur à partir du formulaire
    // Requête SQL pour insérer les données de l'utilisateur dans la base de données
    $query = $db->prepare(
        "INSERT INTO shop_users (email, password, lastname, firstname, idRole) VALUES (:email, :password, :lastname, :firstname, :idRole)"
    );
    $query->execute([
        'email' => $email,
        'password' => $password,
        'lastname' => $lastname,
        'firstname' => $firstname,
        'idRole' => $idRole
    ]);
}