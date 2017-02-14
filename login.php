<?php
require_once('loader.php');
session_start();

$_SESSION['user'] = new ModelGuestUser();
$_SESSION['user']->loadByName($_POST['username']);

if(!$_SESSION['user']->verifyPasswd($_POST['password'])) {
    unset($_SESSION['user']);
}

header('Location: guestbook.php');