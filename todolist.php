<?php

// require_once 'class/DbConnection.php';

// function deleteTask($id) {
//     $sql = 'DELETE FROM tasks WHERE id = :id';

//     $delete = DbConnection::getDb()->prepare($sql);

//     $delete->bindParam(':id', $id);

//     if ($delete->execute()) {
//         echo 'task successfully deleted';
//     }
// }

// if (isset($_POST['delete'])) {
//     deleteTask($_POST['delete']);
// }

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
    <form method="post" id="add-task">
        <input type="text" name="content" id="content" placeholder="Votre tâche">
        <button type="submit" id="add" name="add">Ajouter une tâche</button>
    </form>
    <section id="tofinish">
        <h2>Vos tâches à finir</h2>
        <div class="task-container">

        </div>
    </section>
    <hr>
    <section id="achieved">
        <h2>Vos tâches achevées</h2>
        <div class="task-container">

        </div>
    </section>
</body>
</html>