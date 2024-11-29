    <?php
    include 'userSessionStart.php';
    include '../config/connection.php';

    if (!isset($_SESSION['username'])) {
        header("Location: userLogin.php");
        exit();
    }

    // Assuming you have user details stored in session variables
    $username = $_SESSION['username'];

    // Prepare and execute SQL statement to fetch user details
    $stmt = $conn->prepare("SELECT username, email, contact_num, profile_pic, address, birthday FROM user WHERE username = ?");
    $stmt->bind_param("s", $username); // "s" specifies the variable type => string
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if user data is retrieved
    if ($user) {
        // Extract user information
        $user_username = isset($user['username']) ? $user['username'] : '';
        $user_email = isset($user['email']) ? $user['email'] : '';
        $user_contact = isset($user['contact_num']) ? $user['contact_num'] : '';
        $user_profile_picture = isset($user['profile_pic']) ? $user['profile_pic'] : ''; // Profile picture
        $user_address = isset($user['address']) ? $user['address'] : '';
        $user_birthday = isset($user['birthday']) ? $user['birthday'] : '';
    } else {
        // Handle error: user not found
        echo "User not found.";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get POST data from form
        $email = $_POST['email'] ?? '';
        $contact = $_POST['contact'] ?? '';
        $address = $_POST['address'] ?? '';
        $birthday = $_POST['birthday'] ?? '';

        // Prepare SQL for updating user data
        $update_sql = "UPDATE user SET email = ?, contact_num = ?, address = ?, birthday = ?";

        // Initialize profile_pic as null
        $profile_pic = null;

        // Check if a new profile picture was uploaded
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
            $file = $_FILES['profile_picture'];
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];

            // Check if the file is an image
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array($file_ext, $allowed_extensions)) {
                // Check file size (e.g., limit to 5MB)
                if ($file_size <= 5 * 1024 * 1024) {
                    // Generate a unique name for the file
                    $new_file_name = uniqid('', true) . '.' . $file_ext;
                    $upload_path = '../uploads/profile_pictures/' . $new_file_name;

                    // Move the uploaded file to the desired directory
                    if (move_uploaded_file($file_tmp, $upload_path)) {
                        // Add profile picture update to SQL query
                        $update_sql .= ", profile_pic = ?";
                        $profile_pic = $upload_path;
                    } else {
                        echo "Error uploading the file.";
                        exit();
                    }
                } else {
                    echo "File size exceeds the 5MB limit.";
                    exit();
                }
            } else {
                echo "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
                exit();
            }
        }

        // Finalize the SQL query with values
        $update_sql .= " WHERE username = ?";

        // Prepare the statement to update the user data
        $stmt = $conn->prepare($update_sql);

        // Bind the parameters based on what data is available
        if ($profile_pic) {
            $stmt->bind_param("ssssss", $email, $contact, $address, $birthday, $profile_pic, $username);
        } else {
            $stmt->bind_param("sssss", $email, $contact, $address, $birthday, $username);
        }

        // Execute the update query
        if ($stmt->execute()) {
            // Redirect to user landing page after successful update
            header("Location: userLandingpage.php");
            exit(); // Ensure no further code is executed after the redirect
        } else {
            echo "Error updating profile.";
        }
    }
    ?>

<!DOCTYPE html>
<html>
<head>
    <title>Parish of San Juan</title>
    <link rel="stylesheet" href="userAccountSettings.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        /* Form container and main layout */
        #settingsDiv {
            max-width: 900px;
            margin: 180px auto;
            padding: 20px;
        }

        /* Profile picture section */
        #profilePic {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .form-control {
            height: 50px;
            margin-bottom: 30px;
            width: 100%;
        }

        /* Column layout adjustments for larger screens */
        .col-md-4, .col-md-8 {
            padding: 15px;
        }

        /* Ensure that the profile image and form elements align well */
        .col-md-4 img, .col-md-4 input[type="file"] {
            display: block;
            margin: 0 auto;
        }

        /* Button styling */
        #btnChangePass {
            background-color: gray;
            color: white;
            height: 50px;
            width: 100%;
            margin-bottom: 15px;
        }

        /* Buttons for save and back actions */
        button.btn {
            width: 200px;
            height: 50px;
            font-size: 16px;
        }

        /* Add a margin for the "Save Changes" button */
        button.btn-success {
            margin-right: 15px;
        }

        /* Make sure the layout is responsive on smaller screens */
        @media (max-width: 767px) {
            /* Stack the form sections vertically for mobile */
            .col-md-4, .col-md-8 {
                width: 100%;
                margin-bottom: 20px;
            }

            /* Adjust the profile picture size for mobile */
            #profilePic {
                width: 150px;
                height: 150px;
            }

            /* Adjust input fields width to fit mobile screens */
            .form-control {
                width: 100%;
                height: 40px;
            }

            /* Button styles for mobile */
            button.btn {
                width: 100%;
                margin-bottom: 10px;
            }

            /* Adjust the back button's margin to align properly */
            button.btn-danger {
                width: 100%;
            }
        }
    </style>
    <script>
        function changepass(event) {
            event.preventDefault();
            window.location.href = "userChangePassword.php"; // Redirect to password change page
        }

        function btnback() {
            event.preventDefault();
            window.location.href="userLandingpage.php";
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php include 'userHeader.php'; ?>
    <div id="settingsDiv" class="container">
        <h1 class="text-center">Account Settings</h1>
        <form class="row" method="post" action="" enctype="multipart/form-data">
            <!-- Left side: Username to Contact No. (middle section) -->
            <div class="col-md-4">
                <input type="text" name="username" class="form-control mb-4 fields" placeholder="Username" value="<?php echo htmlspecialchars($user_username); ?>" readonly>
                <input type="email" name="email" class="form-control mb-4 fields" placeholder="Email" value="<?php echo htmlspecialchars($user_email); ?>">
                <input type="number" name="contact" class="form-control mb-4 fields" placeholder="Contact No." value="<?php echo htmlspecialchars($user_contact); ?>">
            </div>

            <!-- Middle side: Profile Picture and File Selection -->
            <div class="col-md-4">
                <img src="<?php echo $profilePicPath; ?>" id="profilePic" alt="Profile Picture" style="width: 250px; height: 250px;">
                <input type="file" name="profile_picture" class="form-control mb-3 fields" accept="image/*">
            </div>

            <!-- Right side: Address, Birthday, and Change Password button -->
            <div class="col-md-4">
                <input type="text" name="address" class="form-control mb-4 fields" placeholder="Address" value="<?php echo htmlspecialchars($user_address); ?>">
                <input type="date" name="birthday" class="form-control mb-4 fields" placeholder="Birthday" value="<?php echo htmlspecialchars($user_birthday); ?>">
                <input type="button" class="form-control fields mb-4" id="btnChangePass" value="Change Password" onclick="changepass(event)">
            </div>

            <!-- Buttons below both columns -->
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success mr-2">Save Changes</button>
                <button type="button" class="btn btn-danger" onclick="btnback(event)">Back</button>
            </div>
        </form>
    </div>
</body>
</html>
