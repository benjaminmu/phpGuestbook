<?php
require_once('loader.php');
session_start();

$guestbook = new ModelGuestbook();
$entry = new ModelGuestbookEntry();
$entry->setAuthor($_SESSION['user']->getId())
    ->setHeadline($_POST['headline'])
    ->setText($_POST['text']);

if ($entry->validate()) {
    $guestbook->saveEntry($entry);
    header('Location: guestbook.php');
    exit(0);
}

$_SESSION['error'] = [
    'message' => $entry->getValidationError(),
];
header('Location: guestbook.php');
exit(0);