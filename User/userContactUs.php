<?php
include 'userSessionStart.php';

$isUserLoggedIn = isset($_SESSION['username']) ? 'true' : 'false';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Parish of San Juan</title>
        <link rel="stylesheet" href="userContact.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script>
            function igopen(event) {
                event.preventDefault();
                window.open("https://www.instagram.com/angtinigsjbp/", '_blank');
            }
            function fbopen(event) {
                event.preventDefault();
                window.open("https://www.facebook.com/parokyangsanjuanhagonoy/", '_blank');
            }
            const isUserLoggedIn = <?php echo $isUserLoggedIn; ?>;

            function requireLogin(event, link) {
                if (!isUserLoggedIn) {
                    event.preventDefault();
                    alert('Please login first to send a message!');
                    window.location.href="userLogin.php";
                    return false;
                }
                return true;
            }
        </script>
    </head>
    <body>
        <?php include 'userHeader.php'; ?>
        <div id="mainDiv">
            <div id="contactDiv">
                <p id="followUsLabel">Follow Us</p>
                <div id="forLogos">
                    <img src="../Images/igLogoBlack.png" onclick="igopen(event)" id="igLogoBlack" class="logos3">
                    <img src="../Images/fblogo2.png" onclick="fbopen(event)" id="fbLogoBlack" class="logos2">
                </div>
                <p id="contactUsLabel">Contact Us</p>
                <p id="gCashNum">For Donation: GCASH: 0949-145-9321</p>
            </div>
            <div id="labelDiv" class="d-flex">
                <p id="parishName">© 2024 Parokya ng San Juan Bautista.</p>
                <a href="comments.php" id="messageUsLink" onclick="return requireLogin(event, this)">Message Us</a>
            </div>
        </div>
    </body>
</html>