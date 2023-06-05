<?php

require_once 'class' . DIRECTORY_SEPARATOR . 'Task.php';
require_once 'class' . DIRECTORY_SEPARATOR . 'User.php';

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
}

$user = new User();

$user->setId($_SESSION['user']->getId());

echo json_encode($user->getAllTasks());