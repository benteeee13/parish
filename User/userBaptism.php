<?php
include 'userSessionStart.php';

if (!isset($_SESSION['username'])) {
    header("Location: userLogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Parish of San Juan</title>
        <link rel="stylesheet" href="userBaptism.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <?php include 'userHeader.php'; ?>
        <div id="baptismOptions">
            <a href="#" id="baptismLabel" class="label">Baptism</a>
            <a href="userBaptismOwnRecords.php" id="certificateRequestLink" class="bg">Certificate Request</a>
            <a href="userBaptismSchedule.php" id="baptismScheduleLink" class="bg">Baptism Schedule</a>
        </div>
    </body>
</html>
