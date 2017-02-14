<?php
require_once('../bootstrap.php');
?>

<?php
//var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/styles.css">
    <meta charset="UTF-8">
    <title>phpGuestbook</title>
</head>
<body>

    <?php
    if (isset($_SESSION['error'])):
    ?>
    <div class="notice error">
        <h3>Achtung:</h3>
        <p><?php echo $_SESSION['error']['message']; ?></p>
    </div>
    <?php
        unset($_SESSION['error']);
        endif;
    ?>

    <?php
    if (isset($_SESSION['notice'])):
        ?>
        <div class="notice">
            <h3>Hinweis:</h3>
            <p><?php echo $_SESSION['notice']['message']; ?></p>
        </div>
    <?php
    unset($_SESSION['notice']);
    endif;
    ?>

    <?php
    if (isset($user) && $user):
    ?>

    <h3>Eintrag schreiben:</h3>
    <form action="saveEntry.php" method="post" class="save-entry">
        <label for="headline">Überschrift</label><input type="text" name="headline"/><br />
        <h4>was du uns sagen möchtest:</h4>
        <textarea name="text" cols="30" rows="10"></textarea><br />
        <input type="submit" value="senden">
        <input type="hidden" name="operation" value="register">
    </form>

    <form action="logout.php" method="post" class="logout">
        <input type="submit" value="abmelden">
        <input type="hidden" name="operation" value="logout">
    </form>

    <?php
    else:
    ?>

    <h3>Anmelden:</h3>
    <form action="login.php" method="post" class="login">
        <label for="username">Nutzername</label><input type="text" name="username"/><br />
        <label for="password">Paßwort</label><input type="text" name="password"/><br />
        <input type="submit" value="senden">
        <input type="hidden" name="operation" value="login">
    </form>

    <h3>oder neu Registrieren:</h3>
    <form action="register.php" method="post" class="register">
        <label for="username">Nutzername</label><input type="text" name="username"/><br />
        <label for="password">Paßwort</label><input type="text" name="password"/><br />
        <label for="passwordRepeat">Paßwort wiederholen</label><input type="text" name="passwordRepeat"/><br />
        <input type="submit" value="senden">
        <input type="hidden" name="operation" value="register">
    </form>

    <?php endif; ?>

    <?php

    ?>

    <div class="gb-wrapper">

        <?php
        $guestbook = new ModelGuestbook($dbConnector);
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

    </div>



</body>
</html>
