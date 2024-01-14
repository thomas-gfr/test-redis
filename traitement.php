<?php 
    require 'config.php';
    include 'crud.php';

    // traitement du formulaire
    if($_SERVER['REQUEST_METHOD'] === 'POST'){    
        // traitement formulaire 
        $userId = $_POST['$userId'] ?? null;
        $userName = $_POST['$userName'] ?? null;
        $userEmail = $_POST['$userEmail'] ?? null;
        $password = $_POST['$password'] ?? null;
        

      if(isset($_POST['create'] && $userId)) {
        // creer un nouvel utilisateur
        createUser($_POST['$userId'], $_POST['userName'], $_POST['userEmail'], $_POST['password']);

      }
    }elseif(isset($_POST['read'])){
        // Lire les données du user 
        $userId = $_POST['userId'];
        $getUserData = readUser($userId);
        echo "<p> donnée de l\'utilisateur" . print_r($getUserData, true);
    }elseif(isset($_POST['delete'])){
        // supprimer utilisateur
        $userId = $_POST['userId'];
        deleteUser($userId);
    }

    //   if (isset($_POST['userId'], $_POST['userName'], $_POST['userEmail'], $_POST['password']);



?>