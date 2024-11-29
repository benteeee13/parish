<?php
include 'adminSessionStart.php';
include '../config/connection.php';

if (!isset($_SESSION['adminUsername'])) {
    header("Location: adminLogin.php");
    exit();
}

if (isset($_GET['id'])) {
    $record_id = (int)$_GET['id'];

    $query = "SELECT * FROM mass_applications WHERE id = $record_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $record = $result->fetch_assoc();
    } else {
        echo "No record found.";
        exit;
    }
} else {
    echo "Invalid record ID.";
    exit; 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send'])) {
    $update_query = "UPDATE mass_applications SET is_forwarded = 1 WHERE id = $record_id";
    
    if ($conn->query($update_query) === TRUE) {
        header("Location: adminPrivateMassTable.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parish of San Juan</title>
    <link rel="stylesheet" href="adminHomepage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script>
        function btnback(event) {
            event.preventDefault();
            window.location.href = "adminPrivateMassTable.php";
        }
    </script>
</head>
<body>
    <?php include 'adminHeader.php'; ?>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-2'>
                <?php include 'adminSidebar.php'; ?>
            </div>
            <div class="container mt-5">
                <h2 id="baptismApplicationLabel">Private Application Details</h2>
                <div id="userReqInfo">
                    <div id="forLabel">
                        <p id="reqInfoLabel">Request No. <?php echo htmlspecialchars($record['id']); ?></p>
                    </div>
                    <div id="applicantInfos" class="d-flex">
                        <div id="leftSide">
                            <p class="applicantData"><?php echo htmlspecialchars($record['requester_name']); ?></p>
                            <p class="applicantDataLabel">Name of Requester</p>
                            <p class="applicantData"><?php echo htmlspecialchars($record['date_of_mass']); ?></p>
                            <p class="applicantDataLabel">Date of Mass</p>
                            <p class="applicantData"><?php echo htmlspecialchars($record['have_parish_choir']); ?></p>
                            <p class="applicantDataLabel">Parish Choir</p>
                        </div>
                        <div id="rightSide">
                            <p class="applicantData"><?php echo htmlspecialchars($record['address']); ?></p>
                            <p class="applicantDataLabel">Address</p>
                            <p class="applicantData"><?php echo htmlspecialchars($record['time_of_mass']); ?></p>
                            <p class="applicantDataLabel">Time of Mass</p>
                            <p class="applicantData"><?php echo htmlspecialchars($record['contact_info']); ?></p>
                            <p class="applicantDataLabel">Contact Info.</p>
                        </div>
                    </div>
                    <div id="forComments">
                        <div id="bottomSide">
                            <p class="funeralApplicantData"><?php echo htmlspecialchars($record['comments']); ?></p>
                        </div>
                        <div id="commentsLabel">
                            <p class="funeralApplicantDataLabel">Comments</p>
                        </div>
                    </div>
                    <form method="post" action="">
                        <div id="forButtons" class="d-flex justify-content-between mt-4">
                            <div id="leftButtons">
                                <button id="backButton" type="button" onclick="btnback(event)">Back</button>
                            </div>
                            <div id="rightButtons" class="d-flex">
                                <button id="archiveButton">Archive</button>
                                <button id="sendButton" name="send" type="submit">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
