<?php
require_once('../bootstrap.php');

$user = new ModelUser($dbConnector);

if (isset(($_POST['username']))) {
    $user->loadByName($_POST['username']);
    $_SESSION['user'] = $user->getId();
}

if (!isset($_POST['password']) || !$user->verifyPasswd($_POST['password'])) {
    unset($_SESSION['user']);
    unset($user);
} else {
    $_SESSION['notice'] = [
        'message' => 'Sie sind jetzt angemeldet als ' . strip_tags(htmlentities($_POST['username'])),
    ];
}

header('Location: guestbook.php');
