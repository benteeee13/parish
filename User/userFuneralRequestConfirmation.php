<?php
include 'userSessionStart.php';
include '../config/connection.php';


// Handle form submission for sending data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from session
    $deceasedName = $_SESSION['deceasedName'];
    $requestorName = $_SESSION['requestorName'];
    $dateOfMass = $_SESSION['datePick'];
    $timeOfMass = $_SESSION['timePick'];
    $contactInfo = $_SESSION['contact'];
    $servicePlace = $_SESSION['servicePlace'];
    $comments = $_SESSION['commentText'];

    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        $username = $_SESSION['username']; // Use logged-in user's username
    } else {
        $username = NULL; // Set username to NULL if not logged in
    }
    
    // Prepare SQL statement
    $sql = "INSERT INTO funeral_applications (username, deceased_name, requestor_name, date_of_mass, time_of_mass, contact_info, service_place, comments) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $username, $deceasedName, $requestorName, $dateOfMass, $timeOfMass, $contactInfo, $servicePlace, $comments);

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
        <link rel="stylesheet" href="userFuneral1.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <?php include 'userHeader.php'; ?>
        <form method="POST" action="">
        <div id="userInfoDiv">
            <a href="#" id="funeralLabel" class="label">Funeral</a>
            <div id="notice">
                <p id="userInfoLabel">Application Confirmation</p>
                <div id="infoContent">
                    <p class="userData"><?php echo $_SESSION['deceasedName']; ?></p>
                    <p class="userDataLabel">Name of Deceased</p>
                    <p class="userData"><?php echo $_SESSION['requestorName']; ?></p>
                    <p class="userDataLabel">Name of Requestor</p>
                    <p class="userData"><?php echo $_SESSION['datePick']; ?></p>
                    <p class="userDataLabel">Date of Mass</p>
                    <p class="userData"><?php echo $_SESSION['timePick']; ?></p>
                    <p class="userDataLabel">Time of Mass</p>
                    <p class="userData"><?php echo $_SESSION['contact']; ?></p>
                    <p class="userDataLabel">Contact Info.</p>
                    <p class="userData"><?php echo $_SESSION['servicePlace']; ?></p>
                    <p class="userDataLabel">Place of Service</p>
                    <p class="userData"><?php echo $_SESSION['commentText']; ?></p>
                    <p class="userDataLabel">Comments</p>
                </div>
                <p id="confirmLabel">Confirm</p>
                <button id="btnBack" type="button" class="btn btn-danger" onclick="window.location.href='userFuneralScheduleApplication.php';">BACK</button>
                <button id="btnSend" type="submit" class="btn btn-success" onclick="btnsend(event)">SEND</button>
            </div>
        </div>
        </form>
    </body>
</html>
