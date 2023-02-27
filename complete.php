<?php

require_once 'class/DbConnection.php';

function completeTask($id) {
    $sql = 'UPDATE tasks SET completion_date = NOW() WHERE id = :id';

    $update = DbConnection::getDb()->prepare($sql);

    $update->bindParam('id', $id, PDO::PARAM_INT);

    $update->execute();
}

completeTask($_POST['finish']);