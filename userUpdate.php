<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<main>
    <div class="container">
        <h1>Modifier Utilisateur</h1>
        <?php
        // Inclure les fichiers nécessaires
        require 'config.php';
        include 'crud.php';

        // Vérifier si l'ID de l'utilisateur à modifier est présent dans l'URL
        if (isset($_GET['userId'])) {
            $userId = filter_var($_GET['userId'], );

            // Récupérer les données de l'utilisateur
            $userData = readUser($userId);

            if (empty($userData)) {
                // Rediriger vers la page d'accueil si l'utilisateur n'est pas trouvé
                header('Location: index.php');
                exit;
            }
        } else {
            // Rediriger vers la page d'accueil si l'ID de l'utilisateur n'est pas fourni
            header('Location: index.php');
            exit;
        }

        // Traitement du formulaire de mise à jour lors de la soumission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateUser'])) {
            // Assurer que les champs requis sont présents dans le formulaire
            if (isset($_POST['newFirstName'], $_POST['newLastName'], $_POST['newAge'], $_POST['newJob'], $_POST['newEmail'])) {
                // Filtrer et sécuriser les entrées du formulaire
                $newFirstName = filter_var($_POST['newFirstName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $newLastName = filter_var($_POST['newLastName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $newAge = filter_var($_POST['newAge'], FILTER_SANITIZE_NUMBER_INT);
                $newJob = filter_var($_POST['newJob'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $newEmail = filter_var($_POST['newEmail'], FILTER_SANITIZE_EMAIL);

                // Appeler la fonction updateUser en passant les données filtrées
                updateUser($userId, $newFirstName, $newLastName, $newAge, $newJob, $newEmail);

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
        <!-- Formulaire de mise à jour de l'utilisateur -->
        <form action="userUpdate.php?userId=<?php echo $userId; ?>" method="post" class="mb-4">
            <div class="form-group">
                <label for="newFirstName">Nouveau Prénom</label>
                <input type="text" class="form-control" id="newFirstName" name="newFirstName" value="<?php echo htmlspecialchars($userData['first_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="newLastName">Nouveau Nom</label>
                <input type="text" class="form-control" id="newLastName" name="newLastName" value="<?php echo htmlspecialchars($userData['last_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="newAge">Nouvel Âge</label>
                <input type="number" class="form-control" id="newAge" name="newAge" value="<?php echo htmlspecialchars($userData['age']); ?>" required>
            </div>
            <div class="form-group">
                <label for="newJob">Nouveau Métier</label>
                <input type="text" class="form-control" id="newJob" name="newJob" value="<?php echo htmlspecialchars($userData['job']); ?>" required>
            </div>
            <div class="form-group">
                <label for="newEmail">Nouvel Email</label>
                <input type="email" class="form-control" id="newEmail" name="newEmail" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="updateUser">Mettre à Jour</button>
        </form>

        <!-- Lien pour revenir à la page d'accueil -->
        <a href="index.php" class="btn btn-secondary">Retour à la Liste des Utilisateurs</a>
    </div>
</main>
</body>
</html>
