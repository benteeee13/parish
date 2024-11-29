<?php include 'userSessionStart.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parish of San Juan</title>
    <link rel="stylesheet" href="userHomepage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v21.0"></script>
       <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (including Popper.js for modals) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <!-- Adding jQuery and Bootstrap JS for carousel functionality -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <script>
        function readmore() { window.location.href = 'userAbout.php'; }
        function btnservices() { window.location.href = 'userService.php'; }
        function massSchedule() { window.location.href = 'massSchedule.php'; }
        function contactUs() { window.location.href = 'userContactUs.php'; }
        function sacraments() { window.location.href = 'userSacraments.php'; }
        function igopen(event) {
                event.preventDefault();
                window.open("https://www.instagram.com/angtinigsjbp/", '_blank');
            }
            function fbopen(event) {
                event.preventDefault();
                window.open("https://www.facebook.com/parokyangsanjuanhagonoy/", '_blank');
            }
        </script>
    <style>
        /* Styles for consistent carousel sizing */
        #imageCarousel .carousel-inner {
            width: 100%;
            height: 350px;
            overflow: hidden;
        }
        
        #imageCarousel .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Custom styling for sections */
        .welcome-section, .mass-schedule-section, .sacraments-section, .video-section, .services-offered-section, .contact-section, .social-section {
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        background-color: white;
        }


        /* Alternating colors for sections */
        .mass-schedule-section, .video-section,   .contact-section{
            background-color: rgba(255, 0, 0, 0.6);
        }

        .carousel-controls {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
        
        /* Contact Section */
        .contact-section img {
            width: 50px;
            
        }

        .welcome-section.bg-white {
            background-color: transparent;
        }

        .container{
            padding: 0 50px;
            margin-top: 125px;
        }

        #forGallery{
            padding: 0 40px;
        }
        
    </style>
    
</head>
<body>
    <header style="margin-bottom: 200px;">
        <?php include 'userHeader.php'; ?>
    </header>
    <div class="container">
        <!-- Welcome Section -->
        <div class="row align-items-center text-center my-5 welcome-section bg-white">
            <div class="col-md-6 mb-3 mb-md-0 position-relative">
                <div id="imageCarousel" class="carousel slide" data-ride="carousel" data-interval="5000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../Images/home.png" class="d-block w-100" alt="Church Image 1">
                        </div>
                        <div class="carousel-item">
                            <img src="../Images/image2.jpg" class="d-block w-100" alt="Church Image 2">
                        </div>
                        <div class="carousel-item">
                            <img src="../Images/angTinig.png" class="d-block w-100" alt="Church Image 3">
                        </div>
                    </div>

                    <a class="carousel-control-prev carousel-controls" href="#imageCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next carousel-controls" href="#imageCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <h2>Welcome to our Parish</h2>
                <p>Parokya ng San Juan Bautista is a Catholic church located in San Juan, Hagonoy, Bulacan. It is part of the Diocese of Malolos, established in 1947. The Parish Fiesta is celebrated every 24th day of June.</p>
                <button class="btn btn-secondary" onclick="readmore()">Read More...</button>
            </div>
        </div>

<!-- Mass Schedule Section with Transparent Dark Red Background -->
<div class="row align-items-center text-center my-5 mass-schedule-section">
    <div class="col-md-6">
        <h2 class="text-light">SET APPOINTMENT</h2>
        <p class="text-light">Services Offered: <br><br> Funeral Mass <br> House Blessings <br> Business Blessings <br> Car Blessings <br> Religious Item Blessing <br> Anointing of the Sick</p>
        <button class="btn btn-secondary mt-4" onclick="massSchedule()">SET APPOINTMENT</button>
    </div>
    <div class="col-md-6">
        <!-- Link to open the image in a modal -->
        <a href="#" data-toggle="modal" data-target="#massScheduleModal">
            <img src="../Images/schedule.jpg" class="img-fluid" alt="Mass Schedule Image">
            <h3 class="text-light mt-3">View Mass Schedule</h3>
        </a>
    </div>
</div>

<!-- Modal for Mass Schedule Image -->
<div class="modal fade" id="massScheduleModal" tabindex="-1" role="dialog" aria-labelledby="massScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <img src="../Images/schedule.jpg" class="img-fluid w-100" alt="Mass Schedule Image">
            </div>
        </div>
    </div>
</div>

        <!-- Sacraments Section -->
        <div class="row align-items-center text-center my-5 sacraments-section bg-white">
            <div class="col-md-6 mb-3 mb-md-0">
                <img src="../Images/sacraments.jpg" class="img-fluid" alt="Sacraments Image" style="width: 100%; height: auto;">
            </div>
            <div class="col-md-6">
                <p>
                    1. BAPTISM<br>2. CONFIRMATION<br>3. EUCHARIST (HOLY COMMUNION)<br>4. RECONCILIATION (PENANCE OR CONFESSION)<br>5. ANNOINTING OF THE SICK<br>6. MATRIMONY (MARRIAGE) <br>7. HOLY ORDERS
                </p>
                <button class="btn btn-secondary mt-4" onclick="sacraments()">Read About Sacraments..</button>
            </div>
        </div>

        <!-- Event Section -->
        <div class="row align-items-center text-center my-5 video-section">
            <div class="col-md-6">
                <h1 class="text-light">SCHEDULE OF EVENTS</h1>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
            </div>
            <div class="col-md-6">
                <h4 class="text-light">NEWS AND EVENTS</h4>
                 <img src="../Images/eventsPic.jpg" class="img-fluid" alt="Event Image" style="width: 450px; height: 450px;">
            </div>
        </div>

        <!-- Services Offered Section -->
       <div class="row align-items-center text-center my-5 services-offered-section bg-white">
    <div class="col-12">
        <h1 class="text-black mb-4">SERVICES OFFERED</h1>
    </div>

    <!-- Baptism -->
    <div class="col-md-4 mb-4">
        <a href="#" onclick="checkLogin('userBaptismSchedule.php')">
            <img src="../Images/baptismLogo.jpg" class="img-fluid rounded shadow" alt="Baptism Image" style="max-height: 200px; width: 100%; object-fit: cover; border: double black;">
        </a>
        <h4 class="text-black mt-2">Baptism</h4>
    </div>

    <!-- Wedding -->
    <div class="col-md-4 mb-4">
        <a href="#" onclick="checkLogin('userWeddingSchedule.php')">
            <img src="../Images/marriageLogo.jpg" class="img-fluid rounded shadow" alt="Wedding Image" style="max-height: 200px; width: 100%; object-fit: cover; border: double black;">
        </a>
        <h4 class="text-black mt-2">Wedding</h4>
    </div>
    <!-- Mass -->
<div class="col-md-4">
    <a href="#" data-bs-toggle="modal" data-bs-target="#massModal">
        <img src="../Images/massLogo.jpg" class="img-fluid rounded shadow" alt="Mass Image" style="max-height: 200px; width: 100%; object-fit: cover; border: double black;">
    </a>
    <h4 class="text-black mt-2">Mass</h4>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="massModal" tabindex="-1" aria-labelledby="massModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="massModalLabel">Choose Mass Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Please select an option:</p>
                <div class="d-grid gap-2">
                    <a href="userFuneralScheduleApplication.php" class="btn btn-primary">Funeral Mass</a>
                    <a href="userPrivateMass.php" class="btn btn-secondary">Private Mass</a>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<script>
    function checkLogin(redirectUrl) {
        <?php if (isset($_SESSION['username'])): ?>
            // If user is logged in, redirect to the requested page
            window.location.href = redirectUrl;
        <?php else: ?>
            // If user is not logged in, show an alert and redirect to the login page
            alert("You must be logged in to continue.");
            window.location.href = "userLogin.php";
        <?php endif; ?>
    }
</script>


</div>

<!-- Video Section -->
<div class="container text-center my-5">
    <div class="row align-items-center justify-content-center" style="background-color: rgba(255,0,0,0.6); border-radius: 10px;">
        <div class="col-md-6 mb-4">
            <p class="text-light">REV. FATHER MELCHOR R. IGNACIO</p>
            <img src="../Images/father.jpg" class="img-fluid" alt="Father Image">
        </div>
        <div class="col-md-6">
            <p class="text-light">FEATURED VIDEO</p>
            <video width="100%" controls>
                <source src="../Images/Featured.mp4" type="video/mp4">
            </video>
        </div>
    </div>
</div>

    <div id="forGallery" >
        <!-- Gallery Section -->
        <div class="container text-center my-1 welcome-section bg-white" style="padding: 10px;">
            <h1 class="col-12 mb-4">GALLERY</h1>

            <!-- Each image thumbnail wrapped in a link that triggers the modal -->
            <div class="row justify-content-center">
                <div class="col-4 col-md-2 mb-1">
                    <a href="#" data-toggle="modal" data-target="#imageModal" data-img-src="../Images/image1.jpg">
                        <img src="../Images/image1.jpg" class="img-fluid rounded shadow gallery-image" alt="Gallery Image 1">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-1">
                    <a href="#" data-toggle="modal" data-target="#imageModal" data-img-src="../Images/image2.jpg">
                        <img src="../Images/image2.jpg" class="img-fluid rounded shadow gallery-image" alt="Gallery Image 2">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-1">
                    <a href="#" data-toggle="modal" data-target="#imageModal" data-img-src="../Images/image3.jpg">
                        <img src="../Images/image3.jpg" class="img-fluid rounded shadow gallery-image" alt="Gallery Image 3">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-1">
                    <a href="#" data-toggle="modal" data-target="#imageModal" data-img-src="../Images/image4.jpg">
                        <img src="../Images/image4.jpg" class="img-fluid rounded shadow gallery-image" alt="Gallery Image 4">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-1">
                    <a href="#" data-toggle="modal" data-target="#imageModal" data-img-src="../Images/image5.jpg">
                        <img src="../Images/image5.jpg" class="img-fluid rounded shadow gallery-image" alt="Gallery Image 5">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-1">
                    <a href="#" data-toggle="modal" data-target="#imageModal" data-img-src="../Images/image6.jpg">
                        <img src="../Images/image6.jpg" class="img-fluid rounded shadow gallery-image" alt="Gallery Image 6">
                    </a>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Structure -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg d-flex align-items-center" role="document">
        <div class="modal-content">
            <div class="modal-body d-flex justify-content-center">
                <img src="" id="modalImage" class="img-fluid" alt="Large view">
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom styling for the gallery images */
    .gallery-image {
        max-height: 150px;
        object-fit: cover;
    }

    /* Modal image adjustments */
    #modalImage {
        margin-top: 100px;
        max-width: 70%;
        max-height: auto; /* Prevents overflow on taller screens */
        object-fit: contain; /* Keeps aspect ratio */
    }

    /* Modal content styling for centering */
    .modal-content {
        background-color: #f8f9fa; /* Light background */
        border-radius: 8px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
    }
</style>

<script>
    // JavaScript to update modal image source based on clicked thumbnail
    $('#imageModal').on('show.bs.modal', function (event) {
        var link = $(event.relatedTarget); // Link that triggered the modal
        var imgSrc = link.data('img-src'); // Extract image source from data attribute
        var modalImage = $('#modalImage'); // Target image in the modal
        modalImage.attr('src', imgSrc); // Update image source in the modal
    });
</script>

    <div class="text-center mt-3" style="background-color: rgba(255,0,0,0.6);">
          <!-- Contact Us Link -->
        <a href="userContactUs.php" style="color: inherit; text-decoration: underline;">Contact Us</a>
        <p style="font-style: white;">&copy;All Rights Reserved<br> 2024 Parokya ng San Juan Bautista. </p>
    </div>
</div>




</div> 
</div>
</body>
</html>
