<?php

require_once 'class' . DIRECTORY_SEPARATOR . 'User.php';
require_once 'class' . DIRECTORY_SEPARATOR . 'Task.php';

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
}

$task = new Task();

if (isset($_POST['content'])) {
    $content = htmlspecialchars(trim($_POST['content']), ENT_QUOTES);

    $task->add($content, $_SESSION['user']->getId());
}