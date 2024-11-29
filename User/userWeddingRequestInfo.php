<?php
include 'userSessionStart.php';
include '../config/connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: userLogin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Store form data in session
    $groomName = htmlspecialchars($_POST['groomName']);
    $brideName = htmlspecialchars($_POST['brideName']);
    $datePick = $_POST['datePick'];
    $contact = htmlspecialchars($_POST['contact']);
    $commentText = htmlspecialchars($_POST['commentText']);

    // Insert data into the database
    $_SESSION['groomName'] = $groomName;
    $_SESSION['brideName'] = $brideName;
    $_SESSION['datePick'] = $datePick;
    $_SESSION['contact'] = $contact;
    $_SESSION['commentText'] = $commentText;

    // Redirect to confirmation page
    header("Location: userWeddingRequestConfirmation.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Parish of San Juan</title>
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
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
        #weddingLabel {
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
        <a href="#" id="weddingLabel" class="label">Wedding</a>
        <div id="notice">
            <form method="POST" onsubmit="return validateForm()">
                <p id="reqInfoLabel">Request Information</p>
                <div class="form-container">
                    <!-- Left Side Inputs -->
                    <div>
                        <label for="groomName">Name of Groom</label>
                        <input type="text" name="groomName" id="groomName" placeholder="Name of Groom" class="textFields">
                        
                        <label for="brideName">Name of Bride</label>
                        <input type="text" name="brideName" id="brideName" placeholder="Name of Bride" class="textFields">
                    </div>
                    
                    <!-- Right Side Inputs -->
                    <div>
                        <label for="datePick">Date of Wedding</label>
                        <input type="date" id="datePick" name="datePick" class="textFields">
                        <label for="contact">Contact Info.</label>
                        <input type="text" name="contact" id="contact" placeholder="Mobile number or email" class="textFields">
                    </div>
                </div>
                    <label for="commentText">Comments</label>
                    <textarea id="commentText" name="commentText" placeholder="Additional information or comments"></textarea>
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
            var groomName = document.getElementById('groomName').value.trim();
            var brideName = document.getElementById('brideName').value.trim();
            var datePick = document.getElementById('datePick').value;
            var contact = document.getElementById('contact').value.trim();
            var commentText = document.getElementById('commentText').value.trim();

            if (!groomName || !brideName || !datePick || !contact || !commentText) {
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
            window.location.href = "userWeddingCertificateRequest.php"; // Adjust to your routing
        }
    </script>
</body>
</html>