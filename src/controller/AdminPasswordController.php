<?php

function AdminPasswordCOntroller($twig)
{
// Vérification de l'existence de la soumission du formulaire
    if (isset($_POST['newpassword'])) {

        // Récupération des valeurs des champs de mot de passe
        $password1 = $_POST['newpassword'];
        $password2 = $_POST['newpassword2'];

        // Vérification si les champs sont vides
        if (empty($password1) || empty($password2)) {
            echo 'Les champs de mot de passe ne peuvent pas être vides';
        } // Vérification si les mots de passe correspondent
        else if ($password1 !== $password2) {
            echo 'Les mots de passe ne correspondent pas';
        } // Traitement des données du formulaire si les mots de passe sont valides
        else {
            // Code pour traiter les données du formulaire, par exemple:
            // Mise à jour du mot de passe dans la base de données

            // Redirection vers la page principale
            header('Location: mainPage.php');
            // Affichage d'un message de succès
            echo 'Modification effectuée avec succès';
        }
    }
}

