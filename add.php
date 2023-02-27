<?php
require_once 'class/DbConnection.php';

function addTask($content) {
    $user_id = 1;
    $date = new DateTime();
    $creation_date = $date->format('Y-m-d H:i:s');


    $sql = 'INSERT INTO tasks (content, creation_date, user_id) VALUES (:content, :creation_date, :user_id)';

    $insert = DbConnection::getDb()->prepare($sql);

    $insert->bindParam(':content', $content);
    $insert->bindParam(':creation_date', $creation_date);
    $insert->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    $insert->execute();
}

$content = $_POST['content'];
addTask($content);


