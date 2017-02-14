<?php
require_once('../bootstrap.php');

if ($_POST['password'] !== $_POST['passwordRepeat']) {
    $_SESSION['error'] = [
        'message' => 'Die Eingegebenen Passwörter stimmen nicht überein.',
    ];
    header('Location: guestbook.php');
    exit(0);
}

$user = new ModelUser($dbConnector);

if (isset($_POST['username'])) {
    $user->setName($_POST['username']);
}
if (isset($_POST['password']) && ($_POST['passwordRepeat'])) {
    $user->setPassword($_POST['password']);
}

if ($user->validate()) {
    $user->register();
    $user->loadByName($_POST['username']);
    $_SESSION['user'] = $user->getId();
    $_SESSION['notice'] = [
        'message' => 'Sie sind jetzt angemeldet als '. strip_tags(htmlentities($_POST['username'])),
    ];

    header('Location: guestbook.php');
    exit(0);
}

$_SESSION['error'] = [
    'message' => $user->getValidationError(),
];
header('Location: guestbook.php');
exit(0);