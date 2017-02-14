<?php
session_start();

require_once('loader.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <title>phpGuestbook</title>
</head>
<body>

<div class="gb-wrapper">

    <?php
    $guestbook = new ModelGuestbook();
    $entries = $guestbook->getEntries();

    foreach ($entries as $index => $entry):
    ?>

    <div class="gb-entry">
        <h3><?php echo $entry->getHeadline(); ?></h3>
        <p class="gb-entry-text">
            <?php echo $entry->getText(); ?>
        </p>
    </div>

    <?php
    endforeach;
    ?>

    <h3>Registrieren:</h3>
    <form action="register.php" method="post" class="register">
        <input type="text" name="username"/><label for="username">Nutzername</label><br />
        <input type="text" name="password"/><label for="password">Paßwort</label><br />
        <input type="text" name="passwordRepeat"/><label for="password">Paßwort wiederholen</label><br />
        <input type="submit" value="senden">
        <input type="hidden" name="operation" value="register">
    </form>

    <h3>Anmelden:</h3>
    <form action="login.php" method="post" class="login">
        <input type="text" name="username"/><label for="username">Nutzername</label><br />
        <input type="text" name="password"/><label for="password">Paßwort</label><br />
        <input type="submit" value="senden">
        <input type="hidden" name="operation" value="login">
    </form>

    <form action="logout.php" method="post" class="login">
        <input type="submit" value="abmelden">
        <input type="hidden" name="operation" value="logout">
    </form>

    <?php
    if (isset($_POST['action'])) {
        switch($_POST['action']) {
            case 'login':
                $_SESSION['user'] = new ModelGuestUser();
                $_SESSION['user']->loadByName($_POST['username']);

                if($_SESSION['user']->verify($_POST['password'])) {
                    // TODO: session login
                    break;
                }
                unset($_SESSION['user']);
                break;
        }
    }


    ?>

</div>

</body>
</html>
