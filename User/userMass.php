<?php
include 'userSessionStart.php'; // Ensure session is managed properly

?>

<!DOCTYPE html>
<html>
<head>
    <title>Parish of San Juan</title>
    <link rel="stylesheet" href="userMass.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
    <body>
        <?php include 'userHeader.php'; ?>
        <div id="funeralOptions">
            <a href="#" id="funeralLabel" class="label">Mass</a>
            <a href="userFuneralScheduleApplication.php" id="userFuneralLink" class="bg">Funeral</a>
            <a href="userPrivateMass.php" id="userPrivateMassLink" class="bg">Private Mass</a>
        </div>
    </body>
</html>
