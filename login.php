<?php
    require_once 'class' . DIRECTORY_SEPARATOR . 'User.php';

    session_start();

    var_dump($_SESSION);
    if (isset($_POST['email'])) {

        $email = htmlspecialchars(trim($_POST['email'], ENT_QUOTES));
        $password = htmlspecialchars(trim($_POST['password'], ENT_QUOTES));

        $login_user = new User();

        try {
            $_SESSION['user'] = $login_user->connect($email, $password);
        } catch (Exception $e) {
            $login_error = $e->getMessage();
        }
    }
?>
<form id="login-form"  action="" method="post">
    <input type="email" name="email" id="email" placeholder="Email">
    <input type="password" name="password" id="password" placeholder="Mot de Passe">
    <input type="submit" name="submit" value="Connexion">

    <?php if (isset($login_error)): ?>
        <p><?= $login_error ?></p>
    <?php elseif (isset($login_success)): ?>
        <p><?= $login_success ?></p>
    <?php endif ?>
</form>