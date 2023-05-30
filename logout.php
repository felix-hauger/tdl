<?php

require_once 'class' . DIRECTORY_SEPARATOR . 'User.php';

$user = new User();

$user->disconnect();

header('Location: index.php');