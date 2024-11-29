<?php 
include 'userSessionStart.php';
include '../config/connection.php';
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query to get the profile picture
    $query = "SELECT profile_pic FROM user WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($profile_picture);
    $stmt->fetch();

    // Check if the user has a profile picture
    if ($profile_picture) {
        $profilePicPath = "../uploads/" . $profile_picture; // Assuming pictures are stored in 'uploads' folder
    } else {
        $profilePicPath = "../Images/profileIcon.png"; // Default image
    }
}
?>
<header class="w-100">
    <link rel="stylesheet" href="userHeader1.css">
    <style>
        .containernav {
            width: 100%;
        }

        nav {
            opacity: 80%;
            background-color: #800000;
            height: 70px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0;
        }

        .white {
            color: white;
        }

        #logo-container {
            display: flex;
            align-items: center;
        }

        #links {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1; /* Ensures links are centered */
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        #links a:hover {
            all: none; /* Add hover effect */
        }

        /* Dropdown styles */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            right: 0;
        }

        .subDropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            left: 100%; /* Align to the right of the parent dropdown */
            top: 0; /* Align with the top of the parent */
        }

        .dropdown-content a,
        .subDropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover,
        .subDropdown-content a:hover {
            background-color: #ddd;
        }

        /* Show dropdown when active */
        .dropdown.show .dropdown-content {
            display: block;
        }

        .subDropdown.show .subDropdown-content {
            display: block;
        }

        /* Style for profile icon */
        #logoSJBPnav {
            max-width: 250px;
            height: 70px;
            margin-left: -20px;
        }

        /* Profile picture styles */
        .profile-picture {
            max-width: 50px;
            margin-right: -40px;
            border-radius: 50%;
            z-index: 10;
            position: relative;
        }
    </style>

    <div class="containernav">
        <nav class="navbar navbar-expand-lg d-flex justify-content-center">
            <!-- Logo on the left -->
            <div id="logo-container">
                <a href="userLandingpage.php"><img src="../Images/logoSJBP.png" alt="Logo SJBP" id="logoSJBPnav" alt="Logo"></a>
            </div>

            <!-- Navigation links in the center -->
            <div id="links" class="d-flex">
                <a href="userLandingpage.php" id="homeLink" class="mx-5">Home</a>

                <!-- Service dropdown -->
                <div class="dropdown">
                    <a href="#" class='white mx-5 dropbtn' id="serviceDropdownBtn">Service</a>
                    <div id="serviceDropdownContent" class="dropdown-content">
                        <div class="subDropdown">
                            <a href="#" class='white subdropbtn' id="certReqDropdownBtn">Request a Certificate</a>
                                <div id="certReqDropdownContent" class="subDropdown-content">
                                    <a href="userBaptismCertificateRequest.php">Baptism</a>
                                    <a href="userWeddingCertificateRequest.php">Wedding</a>
                                </div>
                            <a href="#" class='white subdropbtn' id="schedApplyDropdownBtn">Schedule Application</a>
                                <div id="schedApplyDropdownContent" class="subDropdown-content">
                                    <a href="userBaptismSchedule.php">Baptism</a>
                                    <a href="userWeddingSchedule.php">Wedding</a>
                                    <a href="userFuneralScheduleApplication.php">Funeral</a>
                                    <a href="userPrivateMass.php">Private Mass</a>
                                </div>
                            <a href="#" class='white subdropbtn' id="myRecDropdownBtn">My Records</a>
                                <div id="myRecDropdownContent" class="subDropdown-content">
                                    <a href="userBaptismOwnRecords.php">Baptism</a>
                                    <a href="userWeddingOwnRecords.php">Wedding</a>
                                    <a href="userFuneralOwnRecords.php">Funeral</a>
                                    <a href="userPrivateMassOwnRecords.php">Private Mass</a>
                                </div>
                            <a href="comments.php">Message</a>
                        </div>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#" class='white mx-5 dropbtn' id="aboutLink">About</a>
                        <div id="aboutDropdownContent" class="dropdown-content">
                            <a href="userAbout.php">History</a>
                            <a href="newUserSacraments.php">Sacraments</a>
                        </div>
                    </div>
                <a href="userContactUs.php" id="contactLink" class="mx-5">Contact Us</a>
            </div>

            <?php if (isset($_SESSION['username'])): ?>
                <!-- If logged in, show dropdown for user -->
                <img src="<?php echo $profilePicPath; ?>" class="profile-picture" alt="Profile Picture">
                <div class="dropdown">
                    <a href="#" class="dropbtn white mx-5" id="userDropdownBtn"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
                    <div id="dropdownContent" class="dropdown-content">
                        <a href="userAccountSettings.php">Settings</a>
                        <a href="#" onclick="confirmLogout(event)">Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <!-- If not logged in, show Login dropdown -->
                <div class="dropdown">
                    <a href="#" class='white mx-5 dropbtn' id="loginDropdownBtn">Login</a>
                    <div id="loginDropdownContent" class="dropdown-content">
                        <a href="userLogin.php">Login as User</a>
                        <a href="../Admin/adminLogin.php">Login as Admin</a>
                        <a href="../SuperAdmin/superAdminLogin.php">Login as Super Admin</a>
                    </div>
                </div>
            <?php endif; ?>
        </nav>
    </div>
</header>

<script>

    document.addEventListener("DOMContentLoaded", function () {
    // Get the user dropdown elements
    const userDropdownBtn = document.getElementById("userDropdownBtn");
    const userDropdownContent = document.getElementById("dropdownContent");

    // Attach click event to the user dropdown button
    userDropdownBtn?.addEventListener("click", function (event) {
        event.preventDefault();

        // Toggle the visibility of the dropdown content
        if (userDropdownContent.style.display === "block") {
            userDropdownContent.style.display = "none"; // Close the dropdown
        } else {
            userDropdownContent.style.display = "block"; // Open the dropdown
        }
    });

        // Close the dropdown if the user clicks outside of it
        document.addEventListener("click", function (event) {
            if (!userDropdownBtn?.contains(event.target) && !userDropdownContent?.contains(event.target)) {
                userDropdownContent.style.display = "none"; // Close the dropdown
            }
        });
    });


    document.addEventListener("DOMContentLoaded", function () {
        let currentDropdown = null;
        let currentSubDropdown = null;

        // Function to toggle dropdown visibility
        function toggleDropdown(dropdownId) {
            const dropdownContent = document.getElementById(dropdownId);
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none"; // Close if already open
                currentDropdown = null;
            } else {
                closeAllDropdowns(); // Close other dropdowns
                dropdownContent.style.display = "block"; // Open this dropdown
                currentDropdown = dropdownContent;
            }
        }

        // Function to toggle sub-dropdown visibility
        function toggleSubDropdown(subDropdownId) {
            const subDropdownContent = document.getElementById(subDropdownId);
            if (subDropdownContent.style.display === "block") {
                subDropdownContent.style.display = "none"; // Close if already open
                currentSubDropdown = null;
            } else {
                closeAllSubDropdowns(); // Close other sub-dropdowns
                subDropdownContent.style.display = "block"; // Open this sub-dropdown
                currentSubDropdown = subDropdownContent;
            }
        }

        // Function to close all dropdowns
        function closeAllDropdowns() {
            const dropdowns = document.querySelectorAll(".dropdown-content");
            dropdowns.forEach(function (dropdown) {
                dropdown.style.display = "none";
            });
            closeAllSubDropdowns();
        }

        // Function to close all sub-dropdowns
        function closeAllSubDropdowns() {
            const subDropdowns = document.querySelectorAll(".subDropdown-content");
            subDropdowns.forEach(function (subDropdown) {
                subDropdown.style.display = "none";
            });
        }

        // Check if the user is logged in
        const isLoggedIn = <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;

        // Alert user to log in when accessing restricted features
        function alertLoginRequired(event) {
            if (!isLoggedIn) {
                event.preventDefault();
                alert("Please login first.");
                window.location.href="userLogin.php";
            }
        }

        // Attach event listeners to main dropdown buttons
        document.getElementById("loginDropdownBtn")?.addEventListener("click", function (event) {
            event.preventDefault();
            toggleDropdown("loginDropdownContent");
        });

        document.getElementById("serviceDropdownBtn")?.addEventListener("click", function (event) {
            event.preventDefault();
            toggleDropdown("serviceDropdownContent");
        });

        // Attach event listeners to sub-dropdown buttons under Service
        document.getElementById("certReqDropdownBtn")?.addEventListener("click", function (event) {
            event.preventDefault();
            toggleSubDropdown("certReqDropdownContent");
        });

        document.getElementById("schedApplyDropdownBtn")?.addEventListener("click", function (event) {
            event.preventDefault();
            toggleSubDropdown("schedApplyDropdownContent");
        });

        document.getElementById("myRecDropdownBtn")?.addEventListener("click", function (event) {
            event.preventDefault();
            toggleSubDropdown("myRecDropdownContent");
        });

        document.getElementById("aboutLink")?.addEventListener("click", function (event) {
            event.preventDefault();
            toggleDropdown("aboutDropdownContent");
        });

        // Attach login alert to restricted links
        document.querySelector("a[href='userBaptismCertificateRequest.php']")?.addEventListener("click", alertLoginRequired);
        document.querySelector("a[href='userWeddingCertificateRequest.php']")?.addEventListener("click", alertLoginRequired);
        document.querySelector("a[href='userBaptismSchedule.php']")?.addEventListener("click", alertLoginRequired);
        document.querySelector("a[href='userWeddingSchedule.php']")?.addEventListener("click", alertLoginRequired);
        document.querySelector("a[href='userBaptismOwnRecords.php']")?.addEventListener("click", alertLoginRequired);
        document.querySelector("a[href='userWeddingOwnRecords.php']")?.addEventListener("click", alertLoginRequired);
        document.querySelector("a[href='userFuneralOwnRecords.php']")?.addEventListener("click", alertLoginRequired);
        document.querySelector("a[href='userPrivateMassOwnRecords.php']")?.addEventListener("click", alertLoginRequired);
        document.querySelector("a[href='comments.php']")?.addEventListener("click", alertLoginRequired);

        // Close dropdowns when clicking outside
        document.addEventListener("click", function (event) {
            if (!event.target.closest(".dropdown")) {
                closeAllDropdowns();
            }
        });
    });

    function confirmLogout(event) {
        event.preventDefault();
        if (confirm("Are you sure you want to logout?")) {
            window.location.href = "userLogout.php";
        }
    }
</script>