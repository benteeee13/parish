<?php
include 'userSessionStart.php';
include '../config/connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: userLogin.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get the input values
    $groomName = htmlspecialchars($_POST['groomName']);
    $brideName = htmlspecialchars($_POST['brideName']);
    $datePick = $_POST['datePick'];
    $timePick = $_POST['timePick'];
    $contact = htmlspecialchars($_POST['contact']);
    $commentText = htmlspecialchars($_POST['commentText']);

    // Store values in session
    $_SESSION['groomName'] = $groomName;
    $_SESSION['brideName'] = $brideName;
    $_SESSION['datePick'] = $datePick;
    $_SESSION['timePick'] = $timePick;
    $_SESSION['contact'] = $contact;
    $_SESSION['commentText'] = $commentText;

    // Redirect to confirmation page
    header("Location: userWeddingApplicationConfirmation.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Parish of San Juan</title>
        <link rel="stylesheet" href="userWeddingApplication.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <script>
        function btnback(event) {
            event.preventDefault();
            window.location.href = "userWeddingSchedule.php";
        }

        function validateForm() {
        // Get all form fields and trim extra spaces
        var groomName = document.querySelector('input[placeholder="Name of Groom"]').value.trim().replace(/\s+/g, ' ');
        var brideName = document.querySelector('input[placeholder="Name of Bride"]').value.trim().replace(/\s+/g, ' ');
        var datePick = document.getElementById('datePick').value; // No trim needed for date input
        var timePick = document.getElementById('timePick').value; // No trim needed for date input
        var contact = document.querySelector('input[placeholder="Mobile number or email"]').value.trim().replace(/\s+/g, ' ');
        var commentText = document.getElementById('commentText').value.trim().replace(/\s+/g, ' ');

    // Check if any field is empty
    if (!groomName || !brideName || !datePick || !timePick || !contact || !commentText) {
        alert('All fields must be filled out before proceeding.');
        return false;
    }

    return true;
}

        // Function to proceed to next step
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

        // Restrict past dates and times
        window.onload = function() {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('datePick').setAttribute('min', today);
        };

        document.getElementById('datePick').addEventListener('change', function() {
            var selectedDate = this.value;
            var today = new Date().toISOString().split('T')[0];

            // If the selected date is today, set the minimum selectable time to the current time
            if (selectedDate === today) {
                var currentTime = new Date().toISOString().split('T')[1].slice(0, 5);
                document.getElementById('timePick').min = currentTime;
            } else {
                // Remove the time restriction for future dates
                document.getElementById('timePick').removeAttribute('min');
            }
        });
    </script>
    <body>
        <?php include 'userHeader.php'; ?>
        <div id="formFillUp">
            <a href="#" id="weddingLabel" class="label">Wedding</a>
            <div id="notice">
                <form>
                    <p id="reqInfoLabel">Application Information</p>
                    <div class="form-container">
                        <!-- Left Side Inputs -->
                        <div class="left-side">
                            <p id="groomNameLabel">Name of Groom</p>
                            <input type="text" name="groomName" placeholder="Name of Groom" class="textFields" >
                            <p id="dateLabel">Date</p>
                            <div class="date-time-container">
                                <input type="date" name="datePick" id="datePick" class="textFields">
                                <input type="time" name="timePick" id="timePick" class="textFields">
                            </div>
                        </div>
                        <!-- Right Side Inputs -->
                        <div class="right-side">
                            <p id="brideNameLabel">Name of Bride</p>
                            <input type="text" name="brideName"placeholder="Name of Bride" class="textFields">
                            <p id="contactLabel">Contact Info.</p>
                            <input type="text" name="contact" id="contactInfo" placeholder="Mobile number or email" class="textFields">
                        </div>
                        </div>
                        <p id="commentLabel">Comments</p>
                        <textarea id="commentText" name="commentText" required></textarea>
                    <!-- Buttons -->
                    <button id="btnBack" type="button" class="btn btn-danger" onclick="btnback(event)">BACK</button>
                    <button id="btnNext" type="button" class="btn btn-success" onclick="btnnext(event)">NEXT</button>
                </form>
            </div>
        </div>
    </body>
</html>
