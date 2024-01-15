<?php
require 'crud.php';

// Traitement du formulaire d'ajout d'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['createUser'])) {
    // Assurer que les champs requis sont présents dans le formulaire
    if (isset($_POST['firstName'], $_POST['lastName'], $_POST['age'], $_POST['job'], $_POST['userEmail'], $_POST['password'])) {
        // Filtrer et sécuriser les entrées du formulaire
        $firstName = filter_var($_POST['firstName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastName = filter_var($_POST['lastName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $age = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);
        $job = filter_var($_POST['job'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $userEmail = filter_var($_POST['userEmail'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password']; // Le mot de passe peut être laissé tel quel, car il sera haché dans la fonction createUser

        // Générer un identifiant unique pour l'utilisateur
        $userId = uniqid();

        // Appeler la fonction createUser en passant les données filtrées
        $message = createUser($userId, $firstName, $lastName, $age, $job, $userEmail, $password);

        // Rediriger avec le message de succès ou d'erreur
        $_SESSION['message'] = $message;
        header('Location: index.php');
        exit;
    } else {
        // Message d'erreur si des champs sont manquants
        $_SESSION['message'] = 'Erreur : Certains champs du formulaire d\'ajout sont manquants.';
        header('Location: index.php');
        exit;
    }
}

// Traitement du formulaire de suppression d'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteUser'])) {
    // Assurer que le champ requis est présent dans le formulaire
    if (isset($_POST['deleteUserId'])) {
        // Filtrer et sécuriser l'entrée du formulaire
        $userId = filter_var($_POST['deleteUserId'], FILTER_SANITIZE_STRING);

        // Appeler la fonction deleteUser en passant l'ID filtré
        $message = deleteUser($userId);

        // Rediriger avec le message de succès ou d'erreur
        $_SESSION['message'] = $message;
        header('Location: index.php');
        exit;
    } else {
        // Message d'erreur si le champ de suppression est manquant
        $_SESSION['message'] = 'Erreur : Champ de suppression d\'utilisateur manquant.';
        header('Location: index.php');
        exit;
    }
}

// Fonction de traitement du formulaire de mise à jour de l'utilisateur
function updateUserFormHandler($userId) {
    // Assurer que les champs requis sont présents dans le formulaire
    if (isset($_POST['newFirstName'], $_POST['newLastName'], $_POST['newAge'], $_POST['newJob'], $_POST['newEmail'])) {
        // Filtrer et sécuriser les entrées du formulaire
        $newFirstName = filter_var($_POST['newFirstName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $newLastName = filter_var($_POST['newLastName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $newAge = filter_var($_POST['newAge'], FILTER_SANITIZE_NUMBER_INT);
        $newJob = filter_var($_POST['newJob'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $newEmail = filter_var($_POST['newEmail'], FILTER_SANITIZE_EMAIL);

        // Vérifier si le champ de nouveau mot de passe est présent
        $newPassword = isset($_POST['newPassword']) ? $_POST['newPassword'] : null;

        // Appeler la fonction updateUser en passant les données filtrées
        updateUser($userId, $newFirstName, $newLastName, $newAge, $newJob, $newEmail, $newPassword);

        // Rediriger vers la page d'accueil avec un message de succès
        $_SESSION['message'] = 'Données utilisateur mises à jour avec succès!';
        header('Location: index.php');
        exit;
    } else {
        // Message d'erreur si des champs requis sont manquants
        echo '<div class="alert alert-danger" role="alert">Erreur : Certains champs du formulaire de mise à jour sont manquants.</div>';
    }
}

?>
