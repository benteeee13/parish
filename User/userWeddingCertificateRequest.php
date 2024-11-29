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
        <link rel="stylesheet" href="userWedding3.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script>
            function btncancel(event) {
                event.preventDefault();
                window.location.href = "userCertificateRequest.php";
            }
            function btnaccept(event) {
                event.preventDefault();
                if (document.getElementById('confirmationCheckBox').checked) {
                    window.location.href = "userWeddingRequestInfo.php";
                } else {
                    alert("Please check the box to confirm before proceeding.");
                }
            }
        </script>
    </head>
    <body>
        <?php include 'userHeader.php'; ?>
        <div id="weddingOptions">
            <a href="#" id="weddingLabel" class="label">Wedding</a>
            <div id="notice">
                <form>
                    <h1>NOTICE</h1>
                    <div>
                        <input type="checkbox" id="confirmationCheckBox" required>
                        <span id="p1">By clicking the check box,</span>
                    </div>
                    <p>you confirm that you already have</p>
                    <p>records in St. John the Baptist</p>
                    <p>Parish before you proceed.</p>
                    <button id="btnCancel" type="button" class="btn btn-danger" onclick="btncancel(event)">CANCEL</button>
                    <button id="btnAccept" type="button" class="btn btn-success" onclick="btnaccept(event)">ACCEPT</button>
                </form>
            </div>
        </div>
    </body>
</html>
