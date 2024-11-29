<?php
include 'superAdminSessionStart.php';
include '../config/connection.php';

if (!isset($_SESSION['superAdminUsername'])) {
    header("Location: superAdminLogin.php");
    exit();
}

// Generate a token for form submission
if (empty($_SESSION['form_token'])) {
    $_SESSION['form_token'] = bin2hex(random_bytes(32)); // Generate a secure random token
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check the form token to prevent duplicate submissions
    if (!isset($_POST['form_token']) || $_POST['form_token'] !== $_SESSION['form_token']) {
        $error = "Invalid form submission.";
    } else {
        // Reset the token after validation
        unset($_SESSION['form_token']);

        // Get form data
        $date = $_POST['date'];
        $time = $_POST['time'];
        $status = $_POST['status'];
        $details = $_POST['details'];

        // Validate inputs
        if (empty($date) || empty($time) || empty($status) || empty($details)) {
            $error = "All fields are required.";
        } else {
            // Insert schedule into the database
            $query = "INSERT INTO available_schedule (date, time, status, details) 
                      VALUES ('$date', '$time', '$status', '$details')";
            if (mysqli_query($conn, $query)) {
                // Redirect after successful submission
                header("Location: superAdminAddSchedule.php?success=1");
                exit();
            } else {
                $error = "Failed to add schedule: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Schedule - Parish of San Juan</title>
    <link rel="stylesheet" href="superAdminHomepage1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
          crossorigin="anonymous">
    <script>
        // Disable the submit button after form submission
        function disableSubmitButton() {
            const submitButton = document.querySelector('button[type="submit"]');
            submitButton.disabled = true;
        }
    </script>
    <style>
        #forWhite {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 10px;
        }
    </style>
</head>
<body>
    <?php include 'superAdminHeader.php'; ?>
    <div id="forWhite" class="container mt-5">
        <h2>Add New Schedule</h2>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Schedule added successfully.</div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="" onsubmit="disableSubmitButton()">
            <input type="hidden" name="form_token" value="<?php echo $_SESSION['form_token']; ?>">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Time</label>
                <input type="time" class="form-control" id="time" name="time" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="available">Available</option>
                    <option value="scheduled">Scheduled</option>
                </select>
            </div>
            <div class="form-group">
                <label for="details">Details</label>
                <textarea class="form-control" id="details" name="details" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Schedule</button>
            <a href="superAdminHomepage.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
