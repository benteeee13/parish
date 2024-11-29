<?php
include 'superAdminSessionStart.php';
//session_start(); // Ensure session is started
include '../config/connection.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the login input and password are set
    if (isset($_POST['superAdminLoginInput']) && isset($_POST['superAdminPassword'])) {
        // Get the submitted values
        $loginInput = $_POST['superAdminLoginInput']; // This can be either username or email
        $password = $_POST['superAdminPassword'];

        // Prepare a statement to avoid SQL injection
        $stmt = $conn->prepare("SELECT username, password FROM super_admin WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $loginInput, $loginInput); // Bind parameters for both username and email
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a record was found
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verify the password
            if ($password === $row['password']) { // You may want to use password_hash and password_verify for hashed passwords
                $_SESSION['superAdminUsername'] = $row['username'];
                header("Location: superAdminHomepage.php");
                exit();
            } else {
                echo "<script>alert('Incorrect Password!');</script>";
            }
        } else {
            echo "<script>alert('Incorrect Username or Email!');</script>";
        }
    }
}

// Redirect if already logged in
if (isset($_SESSION['superAdminUsername'])) {
    header("Location: superAdminHomepage.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Parish of San Juan</title>
        <link rel="stylesheet" href="superAdminLogin1.css">   
        <style>
            .diffUser {
                font-weight: lighter;
                font-style: italic;
                color: rgb(10, 10, 100);
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div id="loginDiv">
            <form id ="loginForm" method="POST" action="">
                <img src="../Images/logoSJBP.png" id="logoSJBP">
                <br>
                <label for="loginForm" id="loginFormLabel">PLEASE LOGIN</label>
                <br>
                <input type="text" name="superAdminLoginInput" placeholder="Username or Email" id="txtUser" required>
                <br>
                <input type="password" name="superAdminPassword" placeholder="Password" id="txtPass" required>
                <br>
                <input type="submit" value="Log in" id="btnLogin">
                <br>
                <a href="../Admin/adminLogin.php" class="diffUser">Admin Login</a>
                <br>
                <a href="../User/userLogin.php" class="diffUser">User Login</a>
            </form>
        </div>
    </body>
</html>
