<?php

// Inclure le fichier de configuration et les fonctions CRUD
require 'config.php';
include 'crud.php';

// Traitement du formulaire d'ajout d'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['createUser'])) {
        // Assurer que les champs requis sont présents dans le formulaire
        if (
            isset($_POST['firstName'], $_POST['lastName'], $_POST['age'], $_POST['job'], $_POST['userEmail'], $_POST['password'])
        ) {
            // Filtrer et sécuriser les entrées du formulaire
            $firstName = filter_var($_POST['firstName'], );
            $lastName = filter_var($_POST['lastName'], );
            $age = filter_var($_POST['age'], );
            $job = filter_var($_POST['job'], );
            $userEmail = filter_var($_POST['userEmail'], );
            $password = $_POST['password']; // Le mot de passe peut être laissé tel quel, car il sera haché dans la fonction createUser

            // Générer un identifiant unique pour l'utilisateur
            $userId = uniqid();

            // Appeler la fonction createUser en passant les données filtrées
            createUser($userId, $firstName, $lastName, $age, $job, $userEmail, $password);
        } else {
            echo "Erreur : Certains champs du formulaire sont manquants.";
        }
    }
}

// Traitement du formulaire de mise à jour d'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['updateUser'])) {
        // Assurer que les champs requis sont présents dans le formulaire
        if (isset($_POST['updateUserId'], $_POST['newFirstName'], $_POST['newLastName'], $_POST['newAge'], $_POST['newJob'], $_POST['newEmail'])) {
            // Filtrer et sécuriser les entrées du formulaire
            $userId = filter_var($_POST['updateUserId'], );
            $newFirstName = filter_var($_POST['newFirstName'], );
            $newLastName = filter_var($_POST['newLastName'], );
            $newAge = filter_var($_POST['newAge'], );
            $newJob = filter_var($_POST['newJob'], );
            $newEmail = filter_var($_POST['newEmail'], );

            // Appeler la fonction updateUser en passant les données filtrées
            updateUser($userId, $newFirstName, $newLastName, $newAge, $newJob, $newEmail);
        } else {
            echo "Erreur : Certains champs du formulaire de mise à jour sont manquants.";
        }
    }
}

// Traitement du formulaire de suppression d'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['deleteUser'])) {
        // Assurer que le champ requis est présent dans le formulaire
        if (isset($_POST['deleteUserId'])) {
            // Filtrer et sécuriser l'entrée du formulaire
            $userId = filter_var($_POST['deleteUserId'], );

            // Appeler la fonction deleteUser en passant l'ID filtré
            deleteUser($userId);
        } else {
            echo "Erreur : Champ de suppression d'utilisateur manquant.";
        }
    }
}
?>
