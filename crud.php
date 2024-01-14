<?php
require 'config.php';


// RAJOUTER UN TRY CATCH 
// Créer un nouvel utilisateur 

function createUser($userId, $userName, $userEmail, $password) {
    global $redis;
    $userKey = "user:$userId";
    
    // Hash du mot de passe 
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // données utilisateur 
    $userData = [
        'id' => $userId,
        'name' => $userName,
        'email' => $userEmail,
        'password' => $userPassword,
    ];

    $redis->hMset($userKey, $userData);
}

// Lire les données utilisateur 
function readUser($userId){
    global $redis;
    $userKey = "user:$userId";
    return $redis;
}
// Mettre à jour les données utilisateur 
function updateUser($userId, $newName, $newEmail){
    global $redis;
    $userData = [
        'name' => $newName,
        'email' => newEmail,

    ];
$redis->hMset($userKey, $userData);

// Suprrimer un utilisateur 
function deleteUser($userId){

    global $redis;
    $userKey = "user:$userId";
    $redis->del($userKey);
    
    }
}

?>