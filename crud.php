<?php
// crud.php
require 'config.php';

// Créer un nouvel utilisateur de manière sécurisée
function createUser($userId, $firstName, $lastName, $age, $job, $userEmail, $password) {
    global $redis;

    try {
        $userKey = "utilisateurs:$userId"; // Clé de l'utilisateur dans la base de données "utilisateurs"

        // Hash du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Données utilisateur
        $userData = [
            'id' => $userId,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'age' => $age,
            'job' => $job,
            'email' => $userEmail,
            'password' => $hashedPassword,
        ];

        // Enregistrement des données dans Redis
        $redis->hMset($userKey, $userData);
        return "Utilisateur créé avec succès!";
    } catch (Exception $e) {
        return "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
    }
}

// Lire les données utilisateur de manière sécurisée
function readUser($userId) {
    global $redis;

    try {
        $userKey = "utilisateurs:$userId"; // Clé de l'utilisateur dans la base de données "utilisateurs"
        $userData = $redis->hGetAll($userKey);

        if (!empty($userData)) {
            return $userData;
        } else {
            throw new Exception("Utilisateur non trouvé.");
        }
    } catch (Exception $e) {
        return "Erreur lors de la lecture des données de l'utilisateur : " . $e->getMessage();
    }
}

// Afficher tous les utilisateurs
function getAllUsers() {
    global $redis;

    $userList = [];

    try {
        $keys = $redis->keys("utilisateurs:*");

        foreach ($keys as $key) {
            $userData = $redis->hGetAll($key);
            $userList[] = $userData;
        }

        return $userList;
    } catch (Exception $e) {
        return "Erreur lors de la récupération des utilisateurs : " . $e->getMessage();
    }
}

// Mettre à jour les données utilisateur de manière sécurisée
function updateUser($userId, $newFirstName, $newLastName, $newAge, $newJob, $newEmail) {
    global $redis;

    try {
        $userKey = "utilisateurs:$userId"; // Clé de l'utilisateur dans la base de données "utilisateurs"

        $userData = [
            'first_name' => $newFirstName,
            'last_name' => $newLastName,
            'age' => $newAge,
            'job' => $newJob,
            'email' => $newEmail,
        ];

        // Mise à jour des données dans Redis
        $redis->hMset($userKey, $userData);
        return "Données utilisateur mises à jour avec succès!";
    } catch (Exception $e) {
        return "Erreur lors de la mise à jour des données de l'utilisateur : " . $e->getMessage();
    }
}

// Supprimer un utilisateur de manière sécurisée
function deleteUser($userId) {
    global $redis;

    try {
        $userKey = "utilisateurs:$userId"; // Clé de l'utilisateur dans la base de données "utilisateurs"

        // Suppression de l'utilisateur de Redis
        $redis->del($userKey);
        return "Utilisateur supprimé avec succès!";
    } catch (Exception $e) {
        return "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
    }
}
?>
