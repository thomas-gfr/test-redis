<?php 

require 'crud.php';
require 'config.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RedisCrudApp</title>
</head>
<body>
    <main>
        <div class="container">
            <h1>Redis Crud App</h1>
            <form action="traitement.php" method="post" class="mb-4">
                <div class="form-group">
                    <label for="userId">USER ID</label>
                    <input type="text" class="form-control" id="userId" name="userId" required>
                </div>
                <div class="form-group">
                    <label for="userName">USERNAME</label>
                    <input type="text" class="form-control" id="userName" name="userName" required>
                </div>
                <div class="form-group">
                    <label for="userEmail">EMAIL</label>
                    <input type="text" class="form-control" id="userEmail" name="userEmail" required>
                </div>
                <div class="form-group">
                    <label for="password">PASSWORD</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary" name="create">creer</button>
                <button type="submit" class="btn btn-info" name="read">Lire</button>
                <button type="submit" class="btn btn-warning" name="update">Mettre à jour</button>
                <button type="submit" class="btn btn-danger" name="delete">supprimer</button>


            </form>
        </div>
    </main>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>
</html>