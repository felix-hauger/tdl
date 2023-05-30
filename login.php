<?php
require_once 'class' . DIRECTORY_SEPARATOR . 'User.php';

session_start();

// var_dump($_SESSION);
if (isset($_POST['email'])) {

    $email = htmlspecialchars(trim($_POST['email'], ENT_QUOTES));
    $password = htmlspecialchars(trim($_POST['password'], ENT_QUOTES));

    $login_user = new User();

    try {
        $user = $login_user->connect($email, $password);

        if ($user) {
            $_SESSION['user'] = $user;

            echo 'Connexion réussie !';

            die();
        }
    } catch (Exception $e) {
        echo $e->getMessage();

        die();
    }
}
?>
<form id="login-form" action="" method="post">
    <input type="email" name="email" id="email" placeholder="Email">
    <input type="password" name="password" id="password" placeholder="Mot de Passe">
    <input type="submit" name="submit" value="Connexion">

    <p id="login-msg"></p>
</form>