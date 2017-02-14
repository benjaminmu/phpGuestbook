<?php
require_once('loader.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/styles.css">
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

    <?php
    var_dump($_SESSION);
    ?>

    <?php
    if (count($_SESSION['user'])):
    ?>
    <form action="logout.php" method="post" class="login">
        <input type="submit" value="abmelden">
        <input type="hidden" name="operation" value="logout">
    </form>

    <?php
    else:
    ?>

    <h3>Anmelden:</h3>
    <form action="login.php" method="post" class="login">
        <input type="text" name="username"/><label for="username">Nutzername</label><br />
        <input type="text" name="password"/><label for="password">Paßwort</label><br />
        <input type="submit" value="senden">
        <input type="hidden" name="operation" value="login">
    </form>

    <h3>oder neu Registrieren:</h3>
    <form action="register.php" method="post" class="register">
        <input type="text" name="username"/><label for="username">Nutzername</label><br />
        <input type="text" name="password"/><label for="password">Paßwort</label><br />
        <input type="text" name="passwordRepeat"/><label for="password">Paßwort wiederholen</label><br />
        <input type="submit" value="senden">
        <input type="hidden" name="operation" value="register">
    </form>

    <?php
    endif;
    ?>

    <?php

    ?>

</div>

</body>
</html>
