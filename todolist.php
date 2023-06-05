<?php
require_once 'class' . DIRECTORY_SEPARATOR . 'User.php';

session_start();
// var_dump($_SESSION['user']);

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
}

// var_dump($_SESSION);
// var_dump($_SESSION['user']->getId());
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="js/todo.js"></script>
</head>

<body>
    <?php require_once 'includes' . DIRECTORY_SEPARATOR . 'header.php' ?>

    <main>
        <div class="todolist-container">
            <h2>Vos tâches</h2>

            <button id="mybtn">clique</button>

            <form method="post" id="add-task">
                <input type="text" name="content" id="content" placeholder="Votre tâche">
                <button type="submit" id="add" name="add">Ajouter une tâche</button>
            </form>

            <section id="tofinish">
                <h2>Vos tâches à finir</h2>

                <div class="tasks-container">

                </div>
            </section>

            <hr>

            <section id="achieved">
                <h2>Vos tâches achevées</h2>

                <div class="tasks-container">

                </div>
            </section>
        </div>
    </main>

    <?php require_once 'includes' . DIRECTORY_SEPARATOR . 'footer.php' ?>
</body>

</html>