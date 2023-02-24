<?php

require_once 'class/DbConnection.php';

$pdo = DbConnection::getDb();

function getAllTasks($db) {
    $sql = 'SELECT * FROM tasks WHERE user_id = :user_id';
    $select = DbConnection::getDb()->prepare($sql);
    $user_id = 1;
    $user_tasks = [
        'created' => [],
        'completed' => []
    ];

    $select->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($select->execute()) {
        echo 'ok';
        $tasks = $select->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($tasks);

        // $created_tasks = [];
        // $completed_tasks = [];
        foreach ($tasks as $task) {
            if ($task['completion_date'] === null) {
                // $created_tasks[] = $task;
                $user_tasks['created_tasks'][] = $task;
            } else {
                // $completed_tasks[] = $task;
                $user_tasks['completed_tasks'][] = $task;
            }
        }
    }
    return $user_tasks;
}

function addTask($content, PDO $db) {
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

if (isset($_POST['add'])) {
    $content = $_POST['content'];
    addTask($content, $pdo);
}

$my_tasks = getAllTasks($pdo);
// var_dump($my_tasks);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vos tâches | To Do List</title>
    <link rel="stylesheet" href="style/style.css">
    <script defer src="js/script.js"></script>
</head>
<body>
    <h1>Vos tâches</h1>
    <button id="mybtn">clique</button>
    <form method="post">
        <input type="text" name="content" id="content" placeholder="Votre tâche">
        <button type="submit" id="add" name="add">Ajouter une tâche</button>
    </form>
    <section id="tofinish">
        <h2>Vos tâches à finir</h2>
        <div class="task-container">
            <?php 
            foreach ($my_tasks['created_tasks'] as $key => $task) {
                echo $task['content'] . '  -----  ' . $task['creation_date'] . '<br />';
            }
            ?>

        </div>
    </section>
    <hr>
    <section id="achieved">
        <h2>Vos tâches achevées</h2>
        <div class="task-container">
        <?php 
            foreach ($my_tasks['completed_tasks'] as $key => $task) {
                echo $task['content'] . '  -----  ' . $task['completion_date'] . '<br />';
            }
        ?>
        </div>
    </section>
</body>
</html>