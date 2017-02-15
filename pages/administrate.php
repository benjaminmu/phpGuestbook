<?php
require_once('../bootstrap.php');

if (!$user->isAdmin()) {
    $_SESSION['error'] = [
        'message' => 'Diese Funktion steht nur Admins zur Verfügung.',
    ];
    header('Location: guestbook.php');
    exit(0);
}

if (isset($_POST['action']) && $_POST['action'] == 'validate') {
    $guestbook = new ModelGuestbook($dbConnector);
    $guestbook->validateEntry($_POST['id']);

    $_SESSION['notice'] = [
        'message' => 'Eintrag wurde validiert.',
    ];
    header('Location: guestbook.php');
    exit(0);
}

if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $guestbook = new ModelGuestbook($dbConnector);
    $guestbook->deleteEntry($_POST['id']);

    $_SESSION['notice'] = [
        'message' => 'Eintrag wurde gelöscht.',
    ];
    header('Location: guestbook.php');
    exit(0);
}



