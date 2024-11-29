<?php
include 'userSessionStart.php'; // Ensure session is managed properly

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to the login page
    header("Location: userLogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Parish of San Juan</title>
    <link rel="stylesheet" href="userWedding3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
    <body>
        <?php include 'userHeader.php'; ?>
        <div id="weddingOptions">
            <a href="#" id="weddingLabel" class="label">Wedding</a>
            <a href="userWeddingCertificateRequest.php" id="certificateRequestLink" class="bg">Certificate Request</a>
            <a href="userWeddingSchedule.php" id="weddingScheduleLink" class="bg">Wedding Schedule</a>
        </div>
    </body>
</html>
