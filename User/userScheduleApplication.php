<?php
include 'userSessionStart.php';

$isUserLoggedIn = isset($_SESSION['username']); // Check if user is logged in
?>

<!DOCTYPE html>
<html>
<head>
    <title>Parish of San Juan</title>
    <link rel="stylesheet" href="userService.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script>
        function requireLogin(link) {
            <?php if (!$isUserLoggedIn): ?>
                // If the user is not logged in, show an alert and redirect to login page
                alert("Please login to access this service.");
                window.location.href = "userLogin.php";
                return false;
            <?php else: ?>
                // If logged in, allow the link click
                window.location.href = link.href;
                return true;
            <?php endif; ?>
        }
    </script>
</head>
<body>
    <?php include 'userHeader.php'; ?>
    <div id="superMain" class='col-9'>
        <div id="mainPage">     
            <a href="userBaptismSchedule.php" id="baptismLink" class="bg" onclick="return requireLogin(this)">Baptism</a>
            <a href="userWeddingSchedule.php" id="weddingLink" class="bg" onclick="return requireLogin(this)">Wedding</a>
            <a href="userMass.php" id="massLink" class="bg">Mass</a>
        </div>
    </div>
</body>
</html>
