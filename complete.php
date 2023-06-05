<?php

require_once 'class' . DIRECTORY_SEPARATOR . 'Task.php';

$task = new Task();

$task->complete($_POST['finish']);