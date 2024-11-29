<?php
include 'adminSessionStart.php';
include '../config/connection.php'; // Your existing database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginInput = $_POST['adminLogin']; // Renamed to be more generic
    $password = $_POST['adminPassword'];

    // Prepare and execute a query to check the username or email and password
    $stmt = $conn->prepare("SELECT * FROM admin WHERE (username = ? OR email = ?) AND password = ?");
    $stmt->bind_param("sss", $loginInput, $loginInput, $password); // Bind the same variable for username and email
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['adminUsername'] = $result->fetch_assoc()['username']; // Store the username in session
        header("Location: adminHomepage.php");
        exit();
    } else {
        echo "<script>alert('Incorrect Username/Email or Password!');</script>";
    }
    $stmt->close();
}

if (isset($_SESSION['adminUsername'])) {
    header("Location: adminHomepage.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Parish of San Juan</title>
        <link rel="stylesheet" href="adminLogin.css">
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
            <form id="loginForm" method="POST" action="">
                <img src="../Images/logoSJBP.png" id="logoSJBP">
                <br>
                <label for="loginForm" id="loginFormLabel">PLEASE LOGIN</label>
                <br>
                <input type="text" name="adminLogin" placeholder="Username or Email" id="txtUser" required>
                <br>
                <input type="password" name="adminPassword" placeholder="Password" id="txtPass" required>
                <br>
                <input type="submit" value="Log in" id="btnLogin">
                <br>
                <a href="../Super Admin/superAdminLogin.php" class="diffUser">Super Admin Login</a>
                <br>
                <a href="../User/userLogin.php" class="diffUser">User Login</a>
            </form>
        </div>
    </body>
</html>
