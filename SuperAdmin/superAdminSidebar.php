<?php
include 'superAdminSessionStart.php';
?>
<link rel="stylesheet" href="superAdminSidebar1.css">
<div id="tabSelection">
    <div id="profileInfo">
        <img src="../Images/profileIcon.png" id="userProfilePic" alt="Profile Picture">
        <p id="usernameDisplay2"><?php echo htmlspecialchars($_SESSION['superAdminUsername']); ?></p>
    </div>
    <hr id="tabLine">
    <div id="dashBoardArea">
        <label for="dashBoardArea" id="dashBoardLabel">DASHBOARD</label>
        <div id="dashBoardLinks">
            <a href="superAdminHomepage.php" id="homeLink">Home</a>
            <a href="superAdminService.php" id="serviceLink">Service</a>
            <a href="superAdminRecords.php" id="recordsLink">Records</a>
            <a href="superAdminSchedule.php" id="aboutLink">Available Schedule </a>
        </div>
    </div>
    <div id="maintenanceArea">
        <label for="maintenanceArea" id="maintenanceLabel">MAINTENANCE</label>
        <div id="maintenanceLinks">
            <a href="superAdminUsers.php" id="usersLink">Users</a>
            <a href="superAdminArchive.php" id="archiveLink">Archive</a>
        </div>
    </div>
</div>