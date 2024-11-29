<?php
include 'superAdminSessionStart.php';
?>
<header class="w-100" style="height: 100px;"> <!-- Adjust the height here -->
    <style>
        nav {
            max-height: 200px;
            height: 90%; /* Make nav take up full height */
            max-width: auto;
            opacity: 80%;
            background-color: #800000;
            display: flex;
            align-items: center; /* Vertically center content */
        }
        .white {
            color: white;
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
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #ddd;
        }
    </style>
    <nav class="navbar navbar-expand-lg d-flex justify-content-between">
        <a class="fs-1 white fw-bolder" href="superAdminHomepage.php"> 
        </a>
        <div id="links" class="d-flex">
            <a href="#" class='white' id="usernameDisplay" onclick="toggleDropdown(event)">
                <?php echo isset($_SESSION['superAdminUsername']) ? htmlspecialchars($_SESSION['superAdminUsername']) : 'Guest'; ?>
            </a>
            <?php if (isset($_SESSION['superAdminUsername'])): ?>
                <div class="dropdown">
                    <div id="dropdownContent" class="dropdown-content">
                        <a href="#" onclick="confirmLogout(event)">Logout</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</header>

<script>
    function confirmLogout(event) {
        event.preventDefault(); // Prevent default action of anchor tag
        var confirmation = confirm("Do you really want to log out?");
        if (confirmation) {
            window.location.href = "superAdminLogout.php";
        }
    }

    // Toggle dropdown on click
    function toggleDropdown(event) {
        event.preventDefault();
        var dropdownContent = document.getElementById("dropdownContent");
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    }

    // Close the dropdown if clicked outside
    window.onclick = function(event) {
        if (!event.target.matches('#usernameDisplay')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === "block") {
                    openDropdown.style.display = "none";
                }
            }
        }
    };
</script>
