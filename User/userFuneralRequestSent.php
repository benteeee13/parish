<?php
include 'userSessionStart.php';

if (!isset($_SESSION['username'])) {
    header("Location: userLogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Parish of San Juan</title>
        <link rel="stylesheet" href="userFuneral1.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script>
            function btnok(event) {
                event.preventDefault();
                window.location.href = "userFuneralRequestDone.php";
            }
        </script>
    </head>
    <body>
        <?php include 'userHeader.php'; ?>
        <div id="details">
            <a href="#" id="funeralLabel" class="label">Funeral</a>
            <div id="detailsContent">
                <p id="detailsLabel">Details</p>
                <p class="detailsText">Please wait for your email or contact number for</p>
                <p class="detailsText">confirmation regarding your request.</p>
                <p class="detailsText">if you don't receive an email or text within 1 week,</p>
                <p class="detailsText">please proceed to the parish office.</p>
                <p class="detailsText">Thank you for your cooperation, have a nice day!</p>
                <button id="btnOk" type="button" class="btn btn-success" onclick="btnok(event)">OK</button>
            </div>
        </div>
    </body>
</html>
