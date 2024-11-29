<?php
include 'userSessionStart.php';
include '../config/connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: userLogin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $username = $_SESSION['username'];
    $childName = $_SESSION['childName'];
    $motherName = $_SESSION['motherName'];
    $fatherName = $_SESSION['fatherName'];
    $godmotherName = $_SESSION['godmotherName'];
    $godfatherName = $_SESSION['godfatherName'];
    $datePick = $_SESSION['datePick'];
    $contact = $_SESSION['contact'];
    $commentText = $_SESSION['commentText'];

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO baptism_requests (username, child_name, mother_name, father_name, godmother_name, godfather_name, baptism_date, contact, comments)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Initialize a statement and bind the parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $username, $childName, $motherName, $fatherName, $godmotherName, $godfatherName, $datePick, $contact, $commentText);

    // Execute the statement and check if successful
    if ($stmt->execute()) {
        // Redirect to confirmation page
        header("Location: userBaptismRequestSent.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    session_unset();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Parish of San Juan</title>
        <link rel="stylesheet" href="userBaptism.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script>
            function btnback(event) {
                event.preventDefault();
                window.location.href = "userBaptismRequestInfo.php";
            }
        </script>
    </head>
    <body>
        <?php include 'userHeader.php'; ?>
        <div id="userInfoDiv">
            <a href="#" id="baptismLabel" class="label">Baptism</a>
            <div id="whiteBox">
                <p id="userInfoLabel">Request Confirmation</p>
                <div id="infoContent">
                    <p class="userData"><?php echo $_SESSION['childName']; ?></p>
                    <p class="userDataLabel">Name of Child</p>
                    <p class="userData"><?php echo $_SESSION['motherName']; ?></p>
                    <p class="userDataLabel">Name of Mother</p>
                    <p class="userData"><?php echo $_SESSION['fatherName']; ?></p>
                    <p class="userDataLabel">Name of Father</p>
                    <p class="userData"><?php echo $_SESSION['godmotherName']; ?></p>
                    <p class="userDataLabel">Name of Godmother</p>
                    <p class="userData"><?php echo $_SESSION['godfatherName']; ?></p>
                    <p class="userDataLabel">Name of Godfather</p>
                    <p class="userData"><?php echo $_SESSION['datePick']; ?></p>
                    <p class="userDataLabel">Date Baptized</p>
                    <p class="userData"><?php echo $_SESSION['contact']; ?></p>
                    <p class="userDataLabel">Contact Info</p>
                    <p class="userData"><?php echo $_SESSION['commentText']; ?></p>
                    <p class="userDataLabel">Comments</p>
                </div>
                <p id="confirmLabel">Confirm</p>
                <button id="btnBack" type="button" class="btn btn-danger" onclick="btnback(event)">BACK</button>
                <form method="POST" style="display: inline;">
                    <button id="btnSend" type="submit" class="btn btn-success">SEND</button>
                </form>
            </div>
        </div>
    </body>
</html>
