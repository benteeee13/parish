<?php
include 'userSessionStart.php';
include '../config/connection.php'; // Include database connection

if (!isset($_SESSION['username'])) {
    header("Location: userLogin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get the input values
    $childName = htmlspecialchars($_POST['childName']);
    $motherName = htmlspecialchars($_POST['motherName']);
    $fatherName = htmlspecialchars($_POST['fatherName']);
    $godmotherName = htmlspecialchars($_POST['godmotherName']);
    $godfatherName = htmlspecialchars($_POST['godfatherName']);
    $datePick = $_POST['datePick'];
    $contact = htmlspecialchars($_POST['contact']);
    $commentText = htmlspecialchars($_POST['commentText']);

    // Store values in session
    $_SESSION['childName'] = $childName;
    $_SESSION['motherName'] = $motherName;
    $_SESSION['fatherName'] = $fatherName;
    $_SESSION['godmotherName'] = $godmotherName;
    $_SESSION['godfatherName'] = $godfatherName;
    $_SESSION['datePick'] = $datePick;
    $_SESSION['contact'] = $contact;
    $_SESSION['commentText'] = $commentText;

    // Redirect to confirmation page
    header("Location: userBaptismRequestConfirmation.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title style ="margin-top : 200px;" class="text-center">Parish of San Juan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <style>
        body {
            background-image: url("../Images/mainBG.png");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        #formFillUp {
            max-width: 850px;
            margin: auto;
            margin-top: 100px;
            margin-bottom: 10px;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
        #baptismLabel {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            color: #007bff;
            margin-bottom: 25px;
            display: block;
        }
        #reqInfoLabel {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #343a40;
        }
        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .form-container div {
            flex: 1;
            min-width: 280px;
        }
        label {
            font-weight: bold;
            color: #495057;
            margin-top: 10px;
        }
        .textFields {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            font-size: 16px;
        }
        #commentText {
            width: 100%;
            height: 100px;
            resize: vertical;
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 10px;
            font-size: 16px;
            margin-top: 5px;
            resize: none;
        }
        #btnBack, #btnNext {
            width: 48%;
            font-size: 16px;
            padding: 10px;
            margin-top: 20px;
        }
        #btnBack {
            margin-right: 4%;
        }
    </style>
    
</head>
<body>
    <?php include 'userHeader.php'; ?>
    <div id="formFillUp">
        <a href="#" id="baptismLabel" class="label">Baptism</a>
        <div id="notice">
            <form method="POST" onsubmit="return validateForm()">
                <p id="reqInfoLabel">Request Information</p>
                <div class="form-container">
                    <!-- Left Side Inputs -->
                    <div>
                        <label for="childName">Name of Child</label>
                        <input type="text" name="childName" id="childName" placeholder="Name of Child" class="textFields">
                        
                        <label for="motherName">Name of Mother</label>
                        <input type="text" name="motherName" id="motherName" placeholder="Name of Mother" class="textFields">
                        
                        <label for="fatherName">Name of Father</label>
                        <input type="text" name="fatherName" id="fatherName" placeholder="Name of Father" class="textFields">
                        
                        <label for="godmotherName">Name of Godmother</label>
                        <input type="text" name="godmotherName" id="godmotherName" placeholder="Name of Godmother" class="textFields">
                    </div>
                    
                    <!-- Right Side Inputs -->
                    <div>
                        <label for="godfatherName">Name of Godfather</label>
                        <input type="text" name="godfatherName" id="godfatherName" placeholder="Name of Godfather" class="textFields">
                        
                        <label for="datePick">Date Baptized</label>
                        <input type="date" id="datePick" name="datePick" class="textFields">
                        
                        <label for="contact">Contact Info.</label>
                        <input type="text" name="contact" id="contact" placeholder="Mobile number or email" class="textFields">
                        
                        <label for="commentText">Comments</label>
                        <textarea id="commentText" name="commentText" placeholder="Additional information or comments"></textarea>
                    </div>
                </div>
                
                <!-- Buttons -->
                <div style="display: flex; justify-content: space-between;">
                    <button id="btnBack" type="button" class="btn btn-danger" onclick="btnback(event)">BACK</button>
                    <button id="btnNext" type="submit" class="btn btn-success" onclick="btnnext(event)">NEXT</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            var childName = document.getElementById('childName').value.trim();
            var motherName = document.getElementById('motherName').value.trim();
            var fatherName = document.getElementById('fatherName').value.trim();
            var godmotherName = document.getElementById('godmotherName').value.trim();
            var godfatherName = document.getElementById('godfatherName').value.trim();
            var datePick = document.getElementById('datePick').value;
            var contact = document.getElementById('contact').value.trim();
            var commentText = document.getElementById('commentText').value.trim();

            if (!childName || !motherName || !fatherName || !godmotherName || !godfatherName || !datePick || !contact || !commentText) {
                alert('All fields must be filled out before proceeding.');
                return false;
            }
            return true;
        }

        function btnnext(event) {
            event.preventDefault();
            if (validateForm()) {
                // Prepare form data for submission
                var formData = new FormData(document.querySelector('form'));
                fetch(window.location.href, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.redirected) {
                        window.location.href = response.url; // Redirect to confirmation page
                    }
                });
            }
        }

        function btnback(event) {
            event.preventDefault();
            window.location.href = "userBaptismCertificateRequest.php";
        }
    </script>
</body>
</html>
