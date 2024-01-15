<?php
// traitement.php
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
?>
