<?php
include 'adminSessionStart.php';
include '../config/connection.php'; // Make sure to include the database connection

if (!isset($_SESSION['adminUsername'])) {
    header("Location: adminLogin.php");
    exit();
}

// Set the number of records per page
$records_per_page = 10;

// Get the current page number from the URL, default to 1 if not set
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $records_per_page;

// Fetch records from the baptism_applications table with pagination, filtering by 'pending' status
$query = "SELECT id, requester_name, address, date_of_mass 
          FROM mass_applications 
          WHERE status = 'rejected'
          LIMIT $records_per_page OFFSET $offset";

$result = $conn->query($query);

// Get the total number of 'pending' records to calculate total pages
$total_query = "SELECT COUNT(*) AS total FROM mass_applications WHERE is_forwarded = '1'";
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
    <link rel="stylesheet" href="adminHomepage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
</head>
<body>
    <?php include 'adminHeader.php'; ?>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-2'>
                <?php include 'adminSidebar.php'; ?>
            </div>
            <div class='col-9'>
                 <h2 class='mx-5 mt-5 white'>Approved Schedule</h2>
                <div id="mainPage">
                   <div class="table-container bg-light p-5 ">
                    <div class="d-flex justify-content-between">
                      <div class='d-flex'>
                        <a href='adminFuneralApprovedRequest.php' class='mx-3 text-danger '>CHECK THE APPROVED SCHEDULE </a>
                      </div>
                     <form class="d-flex" role="search">
                      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                      <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    </div>
                        <table class="table table-striped  table-hover">
                          <thead>
                            <tr>
                              <th scope="col">REQUEST NO.</th>
                              <th scope="col">NAME OF REQUESTER</th>
                              <th scope="col">ADDRESS</th>
                              <th scope="col">DATE</th>
                            </tr>
                          </thead>
                          <tbody class="table-group-divider">
                            <?php if ($result->num_rows > 0): ?>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <th scope="row"><?php echo $row['id']; ?></th>
                                            <td><?php echo $row['requester_name']; ?></td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td><?php echo $row['date_of_mass']; ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No records found</td>
                                    </tr>
                                <?php endif; ?>
                          </tbody>
                        </table>
                        <!-- Pagination controls -->
                        <nav aria-label="Page navigation" class="forCentering justify-content-center">
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
                   </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>