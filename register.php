<?php
// var_dump($_POST);
require_once 'class/User.php';

if (isset($_POST['email'])) {

    $email = htmlspecialchars(trim($_POST['email'], ENT_QUOTES));
    $password = htmlspecialchars(trim($_POST['password'], ENT_QUOTES));
    $confirm = htmlspecialchars(trim($_POST['confirm-password'], ENT_QUOTES));
    $firstname = htmlspecialchars(trim($_POST['firstname'], ENT_QUOTES));
    $lastname = htmlspecialchars(trim($_POST['lastname'], ENT_QUOTES));

    $register_user = new User();

    if ($password === $confirm) {
        try {
            if ($register_user->register($email, $password, $firstname, $lastname)) {
                echo 'Inscription réussie !';

                die();
            }
        } catch (Exception $e) {
            echo $e->getMessage();

            die();
        }
    } else {
        echo 'Le mot de passe et la confirmation doivent correspondre';

        die();
    }
}


?>
<form id="register-form" action="" method="post">
    <input type="email" name="email" id="email" placeholder="Email">
    <input type="password" name="password" id="password" placeholder="Mot de Passe">
    <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirmer Mot de Passe">
    <input type="text" name="firstname" id="firstname" placeholder="Prénom">
    <input type="text" name="lastname" id="lastname" placeholder="Nom de Famille">
    <input type="submit" name="submit-register" value="Inscription">

    <p id="register-msg"></p>
</form>