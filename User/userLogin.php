<?php
include 'userSessionStart.php'; // Start the session
include '../config/connection.php'; // Include your database connection

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables to retain input
$input = '';
$error = '';

// Function to verify login credentials
function verifyLogin($conn, $input, $password) {
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT username, password, is_restricted FROM user WHERE username = ? OR email = ? OR contact_num = ?");
    $stmt->bind_param("sss", $input, $input, $input); // Bind input to the prepared statement

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $username = $row['username']; // Retrieve the username from the database
        $hashedPassword = $row['password']; // Retrieve the hashed password from the database
        $isRestricted = $row['is_restricted']; // Retrieve the 'is_restricted' status

        // Check if the account is restricted
        if ($isRestricted == 1) {
            return 'Account is restricted. Please contact support.'; // Account is restricted
        }

        // Verify the entered password against the hashed password
        if (password_verify($password, $hashedPassword)) {
            return $username; // Return the username if login is successful
        }
    }
    return false; // No match found or incorrect password
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST['username']; // Username, email, or contact number
    $password = $_POST['password']; // User password

    $username = verifyLogin($conn, $input, $password);
    if ($username === false) {
        $error = 'Incorrect Username, Email, or Contact Number, or Password!';
    } elseif ($username === 'Account is restricted. Please contact support.') {
        $error = $username; // Display the restriction message
    } else {
        $_SESSION['username'] = $username; // Store the username in session
        header("Location: userLandingpage.php"); // Redirect to the landing page
        exit();
    }
}

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    header("Location: userHomepage.php"); // Redirect to the homepage if already logged in
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Parish of San Juan</title>
    <link rel="stylesheet" href="UserLogin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .loginLinks {
            font-weight: lighter;
            font-style: italic;
            color: rgb(10, 10, 100);
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include 'userHeader.php'; ?>

    <div class="containerdiv">
    <div class="d-flex p-3">
        <div id="loginFormOut">
            <div id="loginDiv">
                <form id="loginForm" method="POST" action="">
                    <br>
                    <img src="../Images/logoSJBP.png" id="logoSJBP" alt="Logo">
                    <br>
                    <p id="loginFormLabel">PLEASE LOGIN</p>
                    <input type="text" name="username" placeholder="Username, Email, or Contact Number" id="txtUser" required value="<?php echo htmlspecialchars($input); ?>">
                    <br>
                    <input type="password" name="password" placeholder="Password" id="txtPass" required>
                    <br>
                    <input type="submit" value="Log in" id="btnLogin">
                    <br>
                    <a href="userForgotPass.php" id="forgotPassLink" class="loginLinks">Forgot Password?</a>
                    <br>
                    <a href="createUserAccount.php" id="createAccount" class="loginLinks">Sign Up</a>
                </form>
                <?php if ($error): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div id="newUserNote">
            <p id="text1">Are you new here?</p>
            <br>
            <p id="text2">"Sign up here and let us provide</p>
            <br>
            <p id="text2dot1">you with our excellent service!"</p>
            <br>
            <input type="button" value="Sign Up" id="btnSignUp" onclick="window.location.href='createUserAccount.php'">
        </div>
    </div>
    </div>

    <?php if (isset($_SESSION['username'])): ?>
        <div class="logout">
            Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?>
            <br>
            <a href="userLogout.php">Logout</a>
        </div>
    <?php endif; ?>
</body>
</html>
