<?php
include 'userSessionStart.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Parish of San Juan</title>
        <link rel="stylesheet" href="userApplicationDetails.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script>
            function btnok(event) {
                event.preventDefault();
                window.location.href = "userApplicationDone.php";
            }
        </script>
    </head>
    <body>
        <?php include 'userHeader.php'; ?>
        <div id="details">
            <a href="#" id="baptismLabel" class="label">Application</a>
            <div id="detailsContent">
                <p id="detailsLabel">Details</p>
                <p class="detailsText">Please await our confirmation for your application.</p>
                <p class="detailsText">If you haven't received confirmation or a</p>
                <p class="detailsText">text within one week, kindly visit the parish office.</p>
                <p class="detailsText">Thank you for your cooperation and have a great day</p>
                <button id="btnOk" type="button" class="btn btn-success" onclick="btnok(event)">OK</button>
            </div>
        </div>
    </body>
</html>
<!--
Please await our confirmation for your application.
If you haven't received confirmation or a text within one week, kindly visit the parish office.
Thank you for your cooperation and have a great day
>