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
    $groomName = htmlspecialchars($_POST['groomName']);
    $brideName = htmlspecialchars($_POST['brideName']);
    $dateMarried = htmlspecialchars($_POST['dateMarried']);
    $timeMarried = htmlspecialchars($_POST['timeMarried']);
    $contactInfo = htmlspecialchars($_POST['contactInfo']);
    $comments = htmlspecialchars($_POST['comments']);

    // Store form data in session
    $_SESSION['groomName'] = $groomName;
    $_SESSION['brideName'] = $brideName;
    $_SESSION['fatherName'] = $fatherName;
    $_SESSION['datePick'] = $dateMarried;
    $_SESSION['timePick'] = $timeMarried;
    $_SESSION['contact'] = $contactInfo;
    $_SESSION['commentText'] = $comments;

    // Redirect to confirmation page
    header("Location: adminWeddingAddRecordsConfirm.php");
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
                    <h2>ADD RECORDS (WEDDING)</h2>
                    <form method="POST">
                        <!-- Mother's and Father's Names -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="groomName">Name of Groom</label>
                                <input type="text" id="groomName" name="groomName" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="brideName">Name of Bride</label>
                                <input type="text" id="brideName" name="brideName" class="form-control" required>
                            </div>
                        </div>

                        <!-- Date and Time of Baptism -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="dateMarried">Date of Marriage</label>
                                <input type="date" id="dateMarried" name="dateMarried" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="timeMarried">Time of Marriage</label>
                                <input type="time" id="timeMarried" name="timeMarried" class="form-control" required>
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

</body>
</html>
