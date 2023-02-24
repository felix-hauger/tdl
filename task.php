<?php

require_once 'class/DbConnection.php';

// $pdo = DbConnection::getDb();

function getAllTasks() {
    $sql = 'SELECT * FROM tasks WHERE user_id = :user_id';
    $select = DbConnection::getDb()->prepare($sql);
    $user_id = 1;

    $select->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($select->execute()) {
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
}

// $my_tasks = getAllTasks($pdo);
echo json_encode(getAllTasks());
// var_dump(json_encode($my_tasks));
// foreach ($my_tasks['created'] as $task) {
//     echo '<p>' . $task['content'] . '  ------  ' . $task['creation_date'] . ' --- ' . $task['completion_date'] . '</p>';
// }
// foreach ($my_tasks['completed'] as $task) {
//     echo '<p>' . $task['content'] . '  ------  ' . $task['creation_date'] . ' --- ' . $task['completion_date'] . '</p>';
// }

// var_dump($my_tasks);

// foreach($my_tasks as $task) {
//     var_dump($task);
// }