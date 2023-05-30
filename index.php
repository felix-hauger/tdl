<?php
require_once 'class' . DIRECTORY_SEPARATOR . 'User.php';

session_start(); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/42d5a324f0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
    <title>Accueil | To Do List</title>
    <script defer src="js/userservice.js"></script>
</head>
<body>
    <?php require_once 'includes' . DIRECTORY_SEPARATOR . 'header.php' ?>

    <main>
        <div id="form-container"></div>
    </main>

    <?php require_once 'includes' . DIRECTORY_SEPARATOR . 'footer.php' ?>
</body>
</html>