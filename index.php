<?php

require_once 'class' . DIRECTORY_SEPARATOR . 'User.php';

session_start();

if (isset($_SESSION['user'])) {
    header('Location: todolist.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style/style.css">
    <title>Accueil | To Do List</title>
    <script defer src="js/userservice.js"></script>
</head>
<body>
    <?php require_once 'includes' . DIRECTORY_SEPARATOR . 'header.php' ?>

    <main>
        <div id="form-container">
            <div id="home-container">
                <h2>Bienvenue sur TODO list !</h2>
                <p>Connectez-vous pour pouvoir suivre votre TODO list</p>
            </div>
        </div>
    </main>

    <?php require_once 'includes' . DIRECTORY_SEPARATOR . 'footer.php' ?>
</body>
</html>