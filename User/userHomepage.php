<?php include 'userSessionStart.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parish of San Juan</title>
    <link rel="stylesheet" href="userHomepage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0" nonce="your_nonce_code"></script>
    <script>
        function readmore() {
            window.location.href = 'userAbout.php';
        }
        
        function btnservices() {
            window.location.href = 'userService.php';
        }
        function massSchedule() {
            window.location.href = 'userMass.php';
        }
        
    </script>
    <style>
        #whole {
            margin-top: 125px;
        }
    </style>
</head>
<body>
    <?php include 'userHeader.php'; ?>
    <!-- Main Content -->
    <div id="whole">
    <div class="container my-5">
        <!-- Welcome Section -->
        <div class="row align-items-center text-center my-5" style="background-color: white; margin-top: 50px; padding: 25px; border-radius: 8px; font-size: 20px;" >
            <div class="col-md-6">
                <img src="../Images/home.png" class="img-fluid" alt="Church Image" style="width: 2000px; height: 200px;">
            </div>
            <div class="col-md-6">
                <h2>Welcome to our Parish</h2>
                <p>Parokya ng San Juan Bautista is a Catholic church located in San Juan, Hagonoy, Bulacan. It is part of the Diocese of Malolos, established in 1947. The Parish Fiesta is celebrated every 24th day of June.</p>
                <?php if (isset($_SESSION['username'])): ?>
                    <button class="btn btn-primary" onclick="btnservices()">SERVICES</button>
                <?php else: ?>
                    <button class="btn btn-secondary" onclick="readmore()">Read More...</button>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <h2>SACRAMENTS</h2>
                <button class="btn btn-secondary mt-4" onclick="btnservices()">SERVICES</button>
            </div>
        </div>


        <hr class="my-5">

        <!-- Mass Schedule Section -->
        <div class="row align-items-center text-center my-5" style="background-color: rgba(255, 0, 0, 0.6); padding: 15px; border-radius: 8px; font-size: 20px;" >
            <div class="col-md-6">
                <h2>Mass SCHEDULE</h2>
                <button class="btn btn-secondary mt-4" onclick="massSchedule()">Private Mass Schedule</button>
            </div>
            <div class="col-md-6">
                <img src="../Images/schedule.jpg" class="img-fluid" alt="Mass Schedule Image">
            </div>
        </div>

        <hr class="my-5">

        <!-- Video Section -->
         <div class="row align-items-center text-center my-5" style="background-color: white; padding: 15px; border-radius: 8px; font-size: 20px;" >
            <div class="col-md-6">
                <img src="../Images/father.jpg" class="img-fluid" alt="Father Image">
            </div>
            <div class="col-md-6">
                <video width="100%" controls>
                    <source src="../Images/Featured.mp4" type="video/mp4">  
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>

        <hr class="my-5">

        <!-- Contact Section -->
        <!-- Contact Section -->
        <div class="row align-items-center text-center my-5" style="background-color: rgba(255, 0, 0, 0.6); padding: 15px; border-radius: 8px; font-size: 20px;" >
            <div class="col-md-6">
                <h2>Contact Us</h2>
                <p>&copy; 2024 Parokya ng San Juan Bautista.</p>
            </div>
            <div class="col-md-6">
                <p>Our Official Facebook and Instagram Page:</p>
                <!-- Wrap the Facebook logo in an anchor link to make it clickable -->
                <a href="https://web.facebook.com/parokyangsanjuanhagonoy/videos/?_rdc=1&_rdr" target="_blank">
                    <img src="../Images/fblogo2.png" class="img-fluid mb-3" alt="Facebook Logo" style="width: 50px; height: auto;">
                </a>
                <a href="https://www.instagram.com/angtinigsjbp/" target="_blank">
                    <img src="../Images/igLogoBlack.png" class="img-fluid mb-3" alt="IG Logo" style="width: 50px; height: auto;">
                </a>
                <img src="../Images/angTinig.png" class="img-fluid" alt="Parish Logo" style="width: 500px; height: auto; margin-top: 10px;">
            </div>
        </div>
    </div>
</body>
</html>