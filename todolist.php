<?php

$pdo = new PDO('mysql:dbname=todolist;host=localhost;charset=utf8mb4', 'root', '');


function addTask($content, $db) {
    $user_id = 1;
    $date = new DateTime();
    $creation_date = $date->format('Y-m-d H:i:s');


    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'INSERT INTO tasks (content, creation_date, user_id) VALUES (:content, :creation_date, :user_id)';

    $insert = $db->prepare($sql);

    $insert->bindParam(':content', $content);
    $insert->bindParam(':creation_date', $creation_date);
    $insert->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    $insert->execute();
}

if (isset($_POST['add'])) {
    $content = $_POST['content'];
    addTask($content, $pdo);
}
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
    <form method="post">
        <input type="text" name="content" id="content" placeholder="Votre tâche">
        <button type="submit" id="add" name="add">Ajouter une tâche</button>
    </form>
    <section id="tofinish">
        <h2>Vos tâches à finir</h2>
        <div class="task-container"></div>
    </section>
    <hr>
    <section id="achieved">
        <h2>Vos tâches achevées</h2>
        <div class="task-container"></div>
    </section>
</body>
</html>