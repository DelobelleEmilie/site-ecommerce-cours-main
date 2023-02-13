<?php

function getOneUserCredentials($db, $email)
{
    // Recupère les utilisateurs de la base de données d'après l'adresse email
    $query = $db->prepare(
        "SELECT id,email,password,idRole FROM shop_users WHERE email = :email AND active = 1"
    );
    $query->execute([
        'email' => $email
    ]);
    return $query->fetchAll();
}

function getOneUser($db, $id)
{
    $query = $db->prepare(
        "SELECT id, email, firstname, lastname, idRole, active FROM shop_users WHERE id = :id"
    );
    $query->execute([
        'id' => $id
    ]);
    return $query->fetch();
}

function saveUser($db, $email, $password, $lastname, $firstname, $idRole, $active)
{
    // Récupération des données de l'utilisateur à partir du formulaire
    // Requête SQL pour insérer les données de l'utilisateur dans la base de données
    $query = $db->prepare(
        "INSERT INTO shop_users (email, password, lastname, firstname, idRole, active) VALUES (:email, :password, :lastname, :firstname, :idRole, :active)"
    );
    $query->execute([
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'lastname' => $lastname,
        'firstname' => $firstname,
        'idRole' => $idRole,
        'active' => $active ? 1 : 0
    ]);
}

function updateUser($db, $id, $email, $lastname, $firstname, $idRole, $active)
{
    $query = $db->prepare("UPDATE shop_users SET email=:email, lastname=:lastname, firstname=:firstname, idRole=:idRole WHERE id=:id");
    $query->execute([
        'id' => $id,
        'email' => $email,
        'lastname' => $lastname,
        'firstname' => $firstname,
        'idRole' => $idRole
    ]);

    return $query->rowCount() > 0;
}

function updateUserPassword($db, $id, $password) {

    $query = $db->prepare("UPDATE shop_users SET password=:password WHERE id=:id");
    $query->execute([
        'id' => $id,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ]);

    return $query->rowCount() > 0;
}

function deleteUser($db, $id)
{
    $query = $db->prepare("DELETE FROM shop_users WHERE id=:id");
    $query->execute(['id' => $id]);

    return $query->rowCount() > 0;
}

function getAllUsers($db)
{
    $query = $db->prepare("SELECT id, email, firstname, lastname, idRole, active FROM shop_users");
    $query->execute();
    return $query->fetchAll();
}

function setUserActive($db, $id, $active)
{
    $query = $db->prepare("UPDATE shop_users SET active = :active WHERE id = :id");

    $query->execute([
        'id' => $id,
        'active' => $active ? 1 : 0
    ]);

    return $query->rowCount() > 0;
}