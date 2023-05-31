<?php

require_once 'class' . DIRECTORY_SEPARATOR . 'DbConnection.php';
require_once 'class' . DIRECTORY_SEPARATOR . 'User.php';

// $pdo = DbConnection::getDb();

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
}

function getAllTasksByUser(int $user_id) {
    $sql = 'SELECT * FROM tasks WHERE user_id = :user_id';
    $select = DbConnection::getDb()->prepare($sql);

    $select->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($select->execute()) {
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
}

// $my_tasks = getAllTasks($pdo);

echo json_encode(getAllTasksByUser($_SESSION['user']->getId()));

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