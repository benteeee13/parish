<?php 
    // Database connection
    include '../config/connection.php';

    // Variables to store error/success messages
    $error = "";
    $success = "";

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $contact_number = $_POST['contact_number'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validate password and confirm password
        if ($password !== $confirm_password) {
            $error = "Passwords do not match!";
        } else {
            // Check if the email or username already exists
            $stmt = $conn->prepare("SELECT id FROM user WHERE email = ? OR username = ?");
            $stmt->bind_param("ss", $email, $username);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                // Email or username already exists
                $error = "Email or Username already exists!";
                $stmt->close();
            } else {
                $stmt->close();

                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Prepare and bind for insert
                $stmt = $conn->prepare("INSERT INTO user (email, username, contact_num, password) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $email, $username, $contact_number, $hashedPassword);

                if ($stmt->execute()) {
                    $success = "Registration successful! You can now <a href='userLogin.php'>log in</a>.";
                } else {
                    $error = "Error: " . $stmt->error;
                }

                $stmt->close();
            }
        }
    }

    $conn->close(); 
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Parish of San Juan</title>
        <link rel="stylesheet" href="createAcc.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <?php include 'userHeader.php'; ?>
        <div class="containerdiv">
            <div class="d-flex p-3">
                <div id="regisUserNote">
                    <p id="texta">Welcome!</p>
                    <br>
                    <p id="textb">Please Login again to get access.</p>
                    <br>
                    <input type="button" value="Sign In" id="btnSignin" onclick="window.location.href='userLogin.php'">
                </div>
                <div id="regisFormOut">
                    <div id="regisDiv">
                        <form id="regisForm" method="POST" action="">
                            <img src="../Images/logoSJBP.png" id="logoSJBP" alt="Logo">
                            <p id="createAccountLabel">CREATE YOUR ACCOUNT</p>
                            
                            <!-- Display error or success message -->
                            <?php if (!empty($error)) : ?>
                                <div class="alert alert-danger"><?php echo $error; ?></div>
                            <?php endif; ?>
                            <?php if (!empty($success)) : ?>
                                <div class="alert alert-success"><?php echo $success; ?></div>
                            <?php endif; ?>
                            
                            <p class="label" id="emailLabel">Email</p>
                            <input type="email" id="txtEmail" name="email" required>
                            
                            <p class="label" id="userNameLabel">Username</p>
                            <input type="text" id="txtUserName" name="username" required>
                            
                            <p class="label" id="contactNumLabel">Contact Number</p>
                            <input type="number" id="txtContactNum" name="contact_number" required>
                            
                            <p class="label" id="passLabel">Password</p>  
                            <input type="password" id="txtPass" name="password" required>
                            
                            <p class="label" id="confirmPassLabel">Confirm Password</p>  
                            <input type="password" id="txtConfirmPass" name="confirm_password" required>
                            
                            <input type="submit" value="Create Your Account" id="btnCreate">
                            <br>
                            <a href="userLogin.php" id="userLoginLink">Already have an account?</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
