<?php

require_once 'class/DbConnection.php';

function deleteTask($id) {
    $sql = 'DELETE FROM tasks WHERE id = :id';

    $delete = DbConnection::getDb()->prepare($sql);

    $delete->bindParam(':id', $id);

    if ($delete->execute()) {
        echo $id;
    }
}

$to_delete = $_POST['delete'];
// echo $to_delete;
deleteTask($to_delete);

// if (deleteTask($_POST['delete'])) {
//     echo $_POST['delete'];
// }