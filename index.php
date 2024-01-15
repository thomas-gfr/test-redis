<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redis Crud App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<main>
    <div class="container">
        <h1>Redis Crud App</h1>
        <?php
        require 'traitement.php';

        // Liste des utilisateurs existants
        $userList = getAllUsers();

        // Récupérer le message de la session
        $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
        unset($_SESSION['message']); // Effacer le message après utilisation
        ?>

        <?php if (!empty($message)): ?>
            <div class="alert <?php echo (strpos($message, 'Erreur') !== false) ? 'alert-danger' : 'alert-success'; ?>" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="traitement.php" method="post" class="mb-4">
            <!-- Champs de formulaire ici (ex : nom, prénom, âge, métier, email, mot de passe) -->
            <div class="form-group">
                <label for="firstName">Prénom</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="lastName">Nom</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <label for="age">Âge</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="job">Métier</label>
                <input type="text" class="form-control" id="job" name="job" required>
            </div>
            <div class="form-group">
                <label for="userEmail">Email</label>
                <input type="email" class="form-control" id="userEmail" name="userEmail" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="createUser">Ajouter Utilisateur</button>
        </form>

        <!-- Affichage de la liste des utilisateurs -->
        <h2>Liste des utilisateurs</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th scope="col">Âge</th>
                <th scope="col">Métier</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($userList as $user): ?>
                <tr>
                    <th scope="row"><?php echo htmlspecialchars($user['id']); ?></th>
                    <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['age']); ?></td>
                    <td><?php echo htmlspecialchars($user['job']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>
                        <form action="traitement.php" method="post">
                            <input type="hidden" name="deleteUserId" value="<?php echo htmlspecialchars($user['id']); ?>">
                            <button type="submit" class="btn btn-danger" name="deleteUser">Supprimer</button>
                        </form>
                        <a href="userUpdate.php?userId=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-warning">Modifier</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
</body>
</html>
