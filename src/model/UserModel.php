<?php

function getOneUserCredentials($db, $email)
{
    // Recupère les utilisateurs de la base de données d'après l'adresse email
    $query = $db->prepare(
        "SELECT id,email,password,idRole FROM shop_users WHERE email = :email"
    );
    $query->execute([
        'email' => $email
    ]);
    return $query->fetchAll();
}

function getOneUser($db, $id)
{
    $query = $db->prepare(
        "SELECT id, email, firstname, lastname, idRole FROM shop_users WHERE id = :id"
    );
    $query->execute([
        'id' => $id
    ]);
    return $query->fetch();
}

function saveUser($db, $email, $password, $lastname, $firstname, $idRole)
{
    // Récupération des données de l'utilisateur à partir du formulaire
    // Requête SQL pour insérer les données de l'utilisateur dans la base de données
    $query = $db->prepare(
        "INSERT INTO shop_users (email, password, lastname, firstname, idRole) VALUES (:email, :password, :lastname, :firstname, :idRole)"
    );
    $query->execute([
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'lastname' => $lastname,
        'firstname' => $firstname,
        'idRole' => $idRole
    ]);
}

function updateUser($db, $id, $email, $lastname, $firstname, $idRole)
{
    $query = $db->prepare("UPDATE shop_users SET email=:email, lastname=:lastname, firstname=:firstname, idRole=:idRole WHERE id=:id");
    $query->execute([
        'id' => $id,
        'email' => $email,
        'lastname' => $lastname,
        'firstname' => $firstname,
        'idRole' => $idRole
    ]);
}

function deleteUser($db, $id)
{
    $query = $db->prepare("DELETE FROM shop_users WHERE id=:id");
    $query->execute(['id' => $id]);
    if ($query->rowCount() > 0) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function getAllUsers($db)
{
    $query = $db->prepare("SELECT id, email, firstname, lastname, idRole FROM shop_users");
    $query->execute();
    return $query->fetchAll();
}