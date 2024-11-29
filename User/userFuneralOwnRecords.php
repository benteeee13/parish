<?php
include 'userSessionStart.php';
include '../config/connection.php'; // Include the database connection

if (!isset($_SESSION['username'])) {
    header("Location: userLogin.php");
    exit();
}

// Set the number of records per page
$records_per_page = 10;

// Get the current page number from the URL, default to 1 if not set
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $records_per_page;

// Sort order for the statuses
$status_order = "CASE 
                    WHEN status = 'Completed' THEN 1
                    WHEN status = 'Approved' THEN 2
                    WHEN status = 'Pending' THEN 3
                    WHEN status = 'Cancelled' THEN 4
                    WHEN status = 'Rejected' THEN 5
                 END";

// Fetch records with the specified status order, only showing non-deleted entries
$query = "SELECT id, deceased_name, status, date_of_mass
          FROM funeral_applications 
          WHERE is_deleted = 0 AND username = '" . $_SESSION['username'] . "'
          ORDER BY $status_order
          LIMIT $records_per_page OFFSET $offset";

$result = $conn->query($query);

// Get the total number of records to calculate total pages
$total_query = "SELECT COUNT(*) AS total FROM funeral_applications WHERE is_deleted = 0";
$total_result = $conn->query($total_query);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $records_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parish of San Juan</title>
    <link rel="stylesheet" href="userTable1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        /* Ensures pagination is centered */
        .pagination {
            display: flex;
            justify-content: center;
            width: 100%;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <?php include 'userHeader.php'; ?>
    <div class='container-fluid'>
        <div class='row'>
            <!-- Center the table by using mx-auto -->
            <div class='col-9 mx-auto'>
                <h2 id="forLabel" class='mx-5 mt-5 white'>Wedding</h2>
                <div id="mainPage">
                    <div class="table-container bg-light p-5 d-flex justify-content-center">
                        <!-- Wrapper div to set max width for the table -->
                        <div class="table-wrapper">
                            <div class="d-flex justify-content-between mb-3">
                                <div class='d-flex'>
                                    <a href="userLandingpage.php" class="btn btn-primary">Back</a>
                                </div>
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </div>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">REQUEST NO.</th>
                                        <th scope="col">NAME OF DECEASED</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">DATE</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <?php if ($result->num_rows > 0): ?>
                                        <?php while ($row = $result->fetch_assoc()): ?>
                                            <tr>
                                                <th scope="row"><?php echo $row['id']; ?></th>
                                                <td><?php echo $row['deceased_name']; ?></td>
                                                <td><?php echo $row['status']; ?></td>
                                                <td><?php echo $row['date_of_mass']; ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No records found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <!-- Pagination controls -->
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item <?php if($current_page <= 1){ echo 'disabled'; } ?>">
                                        <a class="page-link" href="?page=<?php echo $current_page - 1; ?>">Previous</a>
                                    </li>
                                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                        <li class="page-item <?php if($current_page == $i){ echo 'active'; } ?>">
                                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="page-item <?php if($current_page >= $total_pages){ echo 'disabled'; } ?>">
                                        <a class="page-link" href="?page=<?php echo $current_page + 1; ?>">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div> <!-- End of wrapper div -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
