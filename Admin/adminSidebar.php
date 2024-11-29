<?php
include 'adminSessionStart.php';
?>
<link rel="stylesheet" href="adminSidebar.css">
<div id="tabSelection">
    <div id="profileInfo">
        <img src="../Images/profileIcon.png" id="userProfilePic" alt="Profile Picture">
        <p id="usernameDisplay2"><?php echo htmlspecialchars($_SESSION['adminUsername']); ?></p>
    </div>
    <hr id="tabLine">
    <div id="dashBoardArea">
        <label for="dashBoardArea" id="dashBoardLabel">DASHBOARD</label>
        <div id="dashBoardLinks">
            <a href="adminHomepage.php" id="homeLink">Home</a>
            <a href="adminService.php" id="serviceLink">Service</a>
            <a href="adminRecords.php" id="recordsLink">Records</a>
            <a href="adminSchedule.php" id="aboutLink">Available Schedule</a>
        </div>
    </div>
    <div id="maintenanceArea">
        <label for="maintenanceArea" id="maintenanceLabel">MAINTENANCE</label>
        <div id="maintenanceLinks">
            <a href="adminUsers.php" id="usersLink">Users</a>
            <a href="adminArchive.php" id="archiveLink">Archive</a>
        </div>
    </div>
</div>
