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

function saveUser($db, $email, $password, $lastname, $firstname, $role) {
    // Récupération des données de l'utilisateur à partir du formulaire

    $lastname = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $firstname = $_POST["lastname"];
    $role = $_POST["role"];

    // Requête SQL pour insérer les données de l'utilisateur dans la base de données
    $sql = "INSERT INTO shop_users (name, email, password) VALUES ('$lastname', '$email', '$password', '$role','$firstname')";

    if (mysqli_query($db, $sql)) {
        echo "L'utilisateur a été enregistré avec succès.";
    } else {
        echo "Erreur lors de l'enregistrement de l'utilisateur : " . mysqli_error($db);
    }

}