<?php
include 'adminSessionStart.php';
include '../config/connection.php';

if (!isset($_SESSION['adminUsername'])) {
    header("Location: adminLogin.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $groomName = $_SESSION['groomName'];
    $brideName = $_SESSION['brideName'];
    $dateMarried = $_SESSION['datePick'];
    $timeMarried = $_SESSION['timePick'];
    $contact = $_SESSION['contact'];
    $commentText = $_SESSION['commentText'];
    
    $username = NULL;
    $status = "completed";
    $isForwarded = 1;

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO wedding_applications (username, groom_name, bride_name, date_married, time_married, contact_info, status, is_forwarded)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Initialize a statement and bind the parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $username, $groomName, $brideName, $dateMarried, $timeMarried, $contact, $status, $isForwarded);

    // Execute the statement and check if successful
    if ($stmt->execute()) {
        // Redirect to confirmation page
        header("Location: adminWeddingRecords.php");
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
            window.location.href = "adminWeddingAddRecords.php";
        }
    </script>
</head>
<body>
    <?php include 'adminHeader.php'; ?>
    <form method="POST" action="">
        <div id="userInfoDiv">
            <a href="#" id="weddingLabel" class="label">Baptism</a>
            <div id="notice">
                <p id="userInfoLabel">Application Confirmation</p>
                <div id="infoContent">
                    <p class="userData"><?php echo $_SESSION['groomName']; ?></p>
                    <p class="userDataLabel">Name of Groom</p>
                    <p class="userData"><?php echo $_SESSION['brideName']; ?></p>
                    <p class="userDataLabel">Name of Bride</p>
                    <p class="userData"><?php echo $_SESSION['datePick']; ?></p>
                    <p class="userDataLabel">Date Married</p>
                    <p class="userData"><?php echo $_SESSION['timePick']; ?></p>
                    <p class="userDataLabel">Time Married</p>
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
