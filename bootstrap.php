<?php

session_start();

require_once('helper/DbConnector.php');
require_once('model/ModelGuestbook.php');
require_once('model/ModelGuestbookEntry.php');
require_once('model/ModelUser.php');

$dbConnector = new DbConnector();

$user = new ModelUser($dbConnector);

if (isset($_SESSION['user'])) {
    $user->loadById($_SESSION['user']);
} else {
    unset($user);
}

