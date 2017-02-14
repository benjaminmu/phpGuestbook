<?php
require_once('../bootstrap.php');

$guestbook = new ModelGuestbook($dbConnector);
$entry = new ModelGuestbookEntry();

if (count($_SESSION['user'])) {
    $entry->setAuthor($_SESSION['user']);
}
if (isset($_POST['headline'])) {
    $entry->setHeadline($_POST['headline']);
}
if (isset($_POST['text'])) {
    $entry->setText($_POST['text']);
}

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