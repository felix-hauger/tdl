<?php

require_once 'class/DbConnection.php';

$pdo = DbConnection::getDb();

function getAllTasks($db) {
    $sql = 'SELECT * FROM tasks WHERE user_id = :user_id';
    $select = $db->prepare($sql);
    $user_id = 1;
    $user_tasks = [
        'created' => [],
        'completed' => []
    ];

    $select->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($select->execute()) {
        $tasks = $select->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tasks as $task) {
            if ($task['completion_date'] === null) {
                $user_tasks['created'][] = $task;
            } else {
                $user_tasks['completed'][] = $task;
            }
        }
    }
    return $user_tasks;
}

$my_tasks = getAllTasks($pdo);
// var_dump($my_tasks);
foreach ($my_tasks['created'] as $task) {
    echo '<p>' . $task['content'] . '  ------  ' . $task['creation_date'] . ' --- ' . $task['completion_date'] . '</p>';
}
foreach ($my_tasks['completed'] as $task) {
    echo '<p>' . $task['content'] . '  ------  ' . $task['creation_date'] . ' --- ' . $task['completion_date'] . '</p>';
}