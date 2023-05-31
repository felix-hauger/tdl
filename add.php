<?php

require_once 'class' . DIRECTORY_SEPARATOR . 'DbConnection.php';
require_once 'class' . DIRECTORY_SEPARATOR . 'User.php';

session_start();

function addTask($content, $user_id) {
    $date = new DateTime();

    $creation_date = $date->format('Y-m-d H:i:s');

    $sql = 'INSERT INTO tasks (content, creation_date, user_id) VALUES (:content, :creation_date, :user_id)';

    $insert = DbConnection::getDb()->prepare($sql);

    $insert->bindParam(':content', $content);
    $insert->bindParam(':creation_date', $creation_date);
    $insert->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    return $insert->execute();
}

$content = htmlspecialchars(trim($_POST['content']), ENT_QUOTES);
addTask($content, $_SESSION['user']->getId());


