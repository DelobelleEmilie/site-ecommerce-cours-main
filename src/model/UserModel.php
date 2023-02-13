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

    if ($query->rowCount() == 1) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}