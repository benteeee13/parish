<?php
include 'superAdminSessionStart.php';
include '../config/connection.php';

if (!isset($_SESSION['superAdminUsername'])) {
    header("Location: superAdminLogin.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $childName = $_SESSION['childName'];
    $motherName = $_SESSION['motherName'];
    $fatherName = $_SESSION['fatherName'];
    $godmotherName = $_SESSION['godmotherName'];
    $godfatherName = $_SESSION['godfatherName'];
    $dateBaptized = $_SESSION['datePick'];
    $timeBaptized = $_SESSION['timePick'];
    $contact = $_SESSION['contact'];
    $commentText = $_SESSION['commentText'];
    
    $username = NULL;
    $status = "completed";
    $isForwarded = 1;

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO baptism_applications (username, child_name, mother_name, father_name, godmother_name, godfather_name, date_baptized, time_baptized, contact_info, status, is_forwarded)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Initialize a statement and bind the parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $username, $childName, $motherName, $fatherName, $godmotherName, $godfatherName, $dateBaptized, $timeBaptized, $contact, $status, $isForwarded);

    // Execute the statement and check if successful
    if ($stmt->execute()) {
        // Redirect to confirmation page
        header("Location: superAdminBaptismRecords.php");
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baptism Application Confirmation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="userWeddingApplication.css"> <!-- Reuse styling from the second file -->
    <style>

body {
    background-image: url("../Images/mainBG.png");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    font-family: Arial, sans-serif;
}
/* General form container styling */
#userInfoDiv {
    margin: 50px auto;
    padding: 20px;
    border: 2px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    background-color: #f9f9f9;
    max-width: 800px;
    text-align: center;
}

/* Label styling */
#userInfoLabel, #confirmLabel {
    font-size: 24px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 20px;
}

.label {
    display: block;
    font-size: 28px;
    font-weight: 600;
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

/* User data content styling */
#infoContent {
    margin-bottom: 30px;
    text-align: center;
}

.userData {
    font-size: 18px;
    font-weight: 500;
    padding: 5px 0;
    color: #555;
}

.userDataLabel {
    font-size: 14px;
    font-weight: 400;
    color: #777;
    margin-bottom: 10px;
}

/* Button styling */
#btnBack, #btnSend {
    width: 100px;
    margin: 5px;
    font-size: 16px;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#btnBack {
    background-color: #d9534f;
    color: white;
}

#btnBack:hover {
    background-color: #c9302c;
}

#btnSend {
    background-color: #5cb85c;
    color: white;
}

#btnSend:hover {
    background-color: #4cae4c;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    #userInfoDiv {
        margin: 20px;
        padding: 15px;
    }

    .label, #userInfoLabel, #confirmLabel {
        font-size: 20px;
    }

    .userData {
        font-size: 16px;
    }

    .userDataLabel {
        font-size: 12px;
    }

    #btnBack, #btnSend {
        width: 90px;
        font-size: 14px;
        padding: 8px;
    }
}


    </style>
    <script>
        function btnback(event) {
            event.preventDefault();
            window.location.href = "superAdminRecords.php";
        }
    </script>
</head>
<body>
    <?php include 'superAdminHeader.php'; ?>
    <form method="POST" action="">
        <div id="userInfoDiv">
            <a href="#" id="weddingLabel" class="label">Baptism</a>
            <div id="notice">
                <p id="userInfoLabel">Application Confirmation</p>
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
                    <p class="userData"><?php echo $_SESSION['timePick']; ?></p>
                    <p class="userDataLabel">Time Baptized</p>
                    <p class="userData"><?php echo $_SESSION['contact']; ?></p>
                    <p class="userDataLabel">Contact Info</p>
                </div>
                <button id="btnBack" type="button" class="btn btn-danger" onclick="btnback(event)">BACK</button>
                <button id="btnSend" type="submit" class="btn btn-success">ADD</button>
            </div>
        </div>
    </form>
</body>
</html>
