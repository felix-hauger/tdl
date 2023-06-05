<?php

require_once 'class' . DIRECTORY_SEPARATOR . 'Task.php';

$task = new Task();

$task->delete($_POST['delete']);