<?php
require_once('loader.php');
session_start();

if (!count($_SESSION['user'])) {
    $_SESSION['error'] = [
        'message' => 'Sie müssen angemeldet sein, um einen Eintrag verfassen zu können.',
    ];
    header('Location: guestbook.php');
    exit(0);
}

if (!isset($_POST['text']) || $_POST['text'] == '') {
    $_SESSION['error'] = [
        'error' => true,
        'message' => 'Bitte geben sie einen Text in das Eingabefeld ein.',
    ];
    header('Location: guestbook.php');
    exit(0);
}

$guestbook = new ModelGuestbook();
$entry = new ModelGuestbookEntry();
$entry->setAuthor($_SESSION['user']->getId())
    ->setHeadline($_POST['headline'])
    ->setText($_POST['text']);

$guestbook->saveEntry($entry);

header('Location: guestbook.php');