<?php
require_once('loader.php');
session_start();

// new entry
$entry = new ModelGuestbookEntry();
$entry->setAuthor($_SESSION['user']->getId())
    ->setHeadline('')
    ->setText('lalala, 
        hier steht nix');

$guestbook->saveEntry($entry);

header('Location: guestbook.php');