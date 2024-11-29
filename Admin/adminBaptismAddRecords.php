<?php
include 'adminSessionStart.php';
include '../config/connection.php';

if (!isset($_SESSION['adminUsername'])) {
    header("Location: adminLogin.php");
    exit();
}

// Only proceed if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $childName = htmlspecialchars($_POST['childName']);
    $motherName = htmlspecialchars($_POST['motherName']);
    $fatherName = htmlspecialchars($_POST['fatherName']);
    $godmotherNames = htmlspecialchars($_POST['godmotherName']);
    $godfatherNames = htmlspecialchars($_POST['godfatherName']);
    $dateBaptized = htmlspecialchars($_POST['dateBaptized']);
    $timeBaptized = htmlspecialchars($_POST['timeBaptized']);
    $contactInfo = htmlspecialchars($_POST['contactInfo']);
    $comments = htmlspecialchars($_POST['comments']);

    // Store form data in session
    $_SESSION['childName'] = $childName;
    $_SESSION['motherName'] = $motherName;
    $_SESSION['fatherName'] = $fatherName;
    $_SESSION['godmotherNames'] = $godmotherNames;
    $_SESSION['godfatherNames'] = $godfatherNames;
    $_SESSION['datePick'] = $dateBaptized;
    $_SESSION['timePick'] = $timeBaptized;
    $_SESSION['contact'] = $contactInfo;
    $_SESSION['commentText'] = $comments;

    // Redirect to confirmation page
    header("Location: adminBaptismAddRecordsConfirm.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Parish of San Juan</title>
    <link rel="stylesheet" href="adminHomepage5.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include 'adminHeader.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Column -->
            <div class="col-2 p-0" style="min-width: 200px;">
                <?php include 'adminSidebar.php'; ?>
            </div>
            
            <!-- Main Content Column -->
            <div class="col-10">
                <div class="container mt-4">
                    <h2>ADD RECORDS (BAPTISM)</h2>
                    <form method="POST">
                        <!-- Child's Full Name -->
                        <div class="form-group">
                            <label for="childName">Child's Full Name</label>
                            <input type="text" id="childName" name="childName" class="form-control" required>
                        </div>

                        <!-- Mother's and Father's Names -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="motherName">Mother's Name</label>
                                <input type="text" id="motherName" name="motherName" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fatherName">Father's Name</label>
                                <input type="text" id="fatherName" name="fatherName" class="form-control" required>
                            </div>
                        </div>

                        <!-- Godmother's and Godfather's Names -->
                        <div class="form-row">
                            <div class="form-group col-md-6" id="godmotherContainer">
                                <label for="godmotherName">Godmother's Name</label>
                                <input type="text" id="godmotherName" name="godmotherName" class="form-control" placeholder="Godmother's Name">
                            </div>
                            <div class="form-group col-md-6" id="godfatherContainer">
                                <label for="godfatherName">Godfather's Name</label>
                                <input type="text" id="godfatherName" name="godfatherName" class="form-control" placeholder="Godfather's Name">
                            </div>
                        </div>

                        <!-- Date and Time of Baptism -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="dateBaptized">Date of Baptism</label>
                                <input type="date" id="dateBaptized" name="dateBaptized" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="timeBaptized">Time of Baptism</label>
                                <input type="time" id="timeBaptized" name="timeBaptized" class="form-control" required>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="form-group">
                            <label for="contactInfo">Contact Information</label>
                            <input type="text" id="contactInfo" name="contactInfo" class="form-control" required>
                        </div>


                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Add Record</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* General Body Styling */
        body {
     
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            background-image: url("../Images/mainBG.png");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            margin-left: 15px;
        }

        .container {
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 900px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Form Styling */
        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        /* Add Godparent Button */
        .add-godparent-btn {
            background: none;
            color: #007bff;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .add-godparent-btn:hover {
            text-decoration: underline;
        }
    </style>

    <script>
        // Function to dynamically add new godparent fields
        function addGodparent(gender) {
            const container = document.getElementById(gender + 'Container');

            const newDiv = document.createElement("div");
            newDiv.className = "form-group";

            const newLabel = document.createElement("label");
            newLabel.innerText = "Name of " + gender.charAt(0).toUpperCase() + gender.slice(1);
            newDiv.appendChild(newLabel);

            const newInput = document.createElement("input");
            newInput.type = "text";
            newInput.className = "form-control";
            newInput.name = gender + "Name[]";
            newInput.placeholder = "Name of " + gender;
            newDiv.appendChild(newInput);

            container.insertBefore(newDiv, container.querySelector(".add-godparent-btn"));
        }
    </script>
</body>
</html>
