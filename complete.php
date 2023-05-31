<?php

require_once 'class' . DIRECTORY_SEPARATOR . 'DbConnection.php';

function completeTask(int $id): bool {
    $sql = 'UPDATE tasks SET completion_date = NOW() WHERE id = :id';

    $update = DbConnection::getDb()->prepare($sql);

    $update->bindParam('id', $id, PDO::PARAM_INT);

    return $update->execute();
}

completeTask($_POST['finish']);