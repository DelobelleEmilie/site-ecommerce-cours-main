<?php

function getOneUserCredentials($db, $email) {
    // Recupère les utilisateurs de la base de données d'après l'adresse email

    // Récupération de l'adresse e-mail à partir du formulaire
    $email = $_POST["email"];
    // Requête SQL pour sélectionner les utilisateurs avec l'adresse e-mail
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($db, $sql);

    // Boucle pour afficher les utilisateurs
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Afficher les informations de l'utilisateur
            echo "id : " . $row["id"] . " - Nom : " . $row["name"] . " - E-mail : " . $row["email"] . "<br>";
        }
    } else {
        echo "Aucun utilisateur n'a été trouvé avec l'adresse e-mail : " . $email;
    }

    return [];
}

function saveUser($db, $email, $password, $lastname, $firstname, $role) {
    // Récupération des données de l'utilisateur à partir du formulaire

    $lastname = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $firstname = $_POST["lastname"];
    $role = $_POST["role"];

    // Requête SQL pour insérer les données de l'utilisateur dans la base de données
    $sql = "INSERT INTO users (name, email, password) VALUES ('$lastname', '$email', '$password', '$role','$firstname')";

    if (mysqli_query($db, $sql)) {
        echo "L'utilisateur a été enregistré avec succès.";
    } else {
        echo "Erreur lors de l'enregistrement de l'utilisateur : " . mysqli_error($db);
    }

}