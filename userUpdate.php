<?php
include 'header.html';
?>
<main>
    <div class="container">
        <h1>Modifier Utilisateur</h1>
        <?php
        // Inclure les fichiers nécessaires
        require 'config.php';
        include 'crud.php';
        include 'traitement.php';

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
            // Appeler la fonction de traitement du formulaire
            updateUserFormHandler($userId);
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
            <div class="form-group">
                <label for="newPassword">Nouveau Mot de passe</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword">
            </div>
            <button type="submit" class="btn btn-primary" name="updateUser">Mettre à Jour</button>
        </form>

        <!-- Lien pour revenir à la page d'accueil -->
        <a href="index.php" class="btn btn-secondary">Retour à la Liste des Utilisateurs</a>
    </div>
</main>
<?php
include 'footer.html';
?>
