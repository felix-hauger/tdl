<?php

require_once 'class' . DIRECTORY_SEPARATOR . 'Task.php';
require_once 'class' . DIRECTORY_SEPARATOR . 'User.php';

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
}

if (isset($_POST['delete'])) {
    $task = new Task();
    
    $task->delete($_POST['delete']);
}