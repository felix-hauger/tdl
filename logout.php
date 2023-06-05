<?php

require_once 'class' . DIRECTORY_SEPARATOR . 'User.php';

$user = new User();

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
}

$user->disconnect();

header('Location: index.php');