<?php

require_once 'class' . DIRECTORY_SEPARATOR . 'User.php';
require_once 'class' . DIRECTORY_SEPARATOR . 'Task.php';

session_start();

$task = new Task();

$content = htmlspecialchars(trim($_POST['content']), ENT_QUOTES);

$task->add($content, $_SESSION['user']->getId());