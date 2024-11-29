<?php
include 'userSessionStart.php';
include '../config/connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: userLogin.php");
    exit();
}

// Handle form submission for sending data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from session
    $username = $_SESSION['username'];
    $groomName = $_SESSION['groomName'];
    $brideName = $_SESSION['brideName'];
    $dateMarried = $_SESSION['datePick'];
    $timeMarried = $_SESSION['timePick'];
    $contactInfo = $_SESSION['contact'];
    $comments = $_SESSION['commentText'];
    
    // Prepare SQL statement
    $sql = "INSERT INTO wedding_applications (username, groom_name, bride_name, date_married, time_married, contact_info, comments) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $username, $groomName, $brideName, $dateMarried, $timeMarried, $contactInfo, $comments);

    // Execute statement
    if ($stmt->execute()) {
        // Redirect to userApplicationDetails.php
        header("Location: userApplicationDetails.php");
        exit();
    } else {
        // Handle error (you can add error handling code here)
        echo "Error: " . $stmt->error;
    }

            // Close statement
    $stmt->close();
    // Clear session data if needed
    session_unset();
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Parish of San Juan</title>
        <link rel="stylesheet" href="userWeddingApplication.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script>
            function btnback(event) {
                event.preventDefault();
                window.location.href = "userWeddingApplication.php";
            }
        </script>
    </head>
    <body>
        <?php include 'userHeader.php'; ?>
        <form method="POST" action="">
        <div id="userInfoDiv">
            <a href="#" id="weddingLabel" class="label">Wedding</a>
            <div id="notice">
                <p id="userInfoLabel">Application Confirmation</p>
                <div id="infoContent">
                    <p class="userData"><?php echo $_SESSION['groomName']; ?></p>
                    <p class="userDataLabel">Name of Groom</p>
                    <p class="userData"><?php echo $_SESSION['brideName']; ?></p>
                    <p class="userDataLabel">Name of Bride</p>
                    <p class="userData"><?php echo $_SESSION['datePick']; ?></p>
                    <p class="userDataLabel">Date of Marriage</p>
                    <p class="userData"><?php echo $_SESSION['timePick']; ?></p>
                    <p class="userDataLabel">Time of Marriage</p>
                    <p class="userData"><?php echo $_SESSION['contact']; ?></p>
                    <p class="userDataLabel">Contact Info</p>
                    <p class="userData"><?php echo $_SESSION['commentText']; ?></p>
                    <p class="userDataLabel">Comments</p>
                </div>
                <p id="confirmLabel">Confirm</p>
                <button id="btnBack" type="button" class="btn btn-danger" onclick="btnback(event)">BACK</button>
                <button id="btnSend" type="submit" class="btn btn-success" onclick="btnsend(event)">SEND</button>
            </div>
        </div>
        </form>
    </body>
</html>
