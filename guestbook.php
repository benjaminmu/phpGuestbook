<?php
require_once('helper/HelperDbConnector.php');
require_once('model/ModelDbEntity.php');
require_once('model/ModelGuestbook.php');
require_once('model/ModelGuestbookEntry.php');
require_once('model/ModelUser.php');
require_once('model/ModelGuestUser.php');
require_once('model/ModelAdminUser.php');
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

    <?php
    $user = new ModelGuestUser();
    $user->loadByName('colamann');
    var_dump($user);
    ?>

</div>

</body>
</html>
