<?php
include '../config/connection.php'; // Include database connection

// Check if `id` parameter is provided
if (!isset($_GET['id'])) {
    die('Invalid request.');
}

$id = $_GET['id'];

// Fetch record details from the database
$query = "SELECT * FROM wedding_applications WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die('No record found.');
}

$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Wedding</title>
    <style>
        @page {
            margin: 2rem;
            size: 8.5in 11in;
            /* Letter size */
        }

        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
            padding: 0;
            height: 97vh;
            border: 10px solid brown;
        }

        .certificate {
            width: 100%;
            max-width: 850px;
            margin: auto;
            padding: 30px;

            background-color: #fff;
            text-align: center;
            box-sizing: border-box;
            position: relative;
        }

        .certificate h1 {
            font-size: 2em;
            text-transform: uppercase;
            margin: 0;
            font-weight: bold;
        }

        .certificate h2 {
            font-size: 1.5em;
            margin: 0 0 20px;
            text-transform: uppercase;
        }

        .certificate p {
            font-size: 1.2em;
            margin: 10px 0;
            line-height: 1.5;
        }

        .line {
            border-bottom: 1px solid black;
            display: inline-block;
            width: 60%;
        }

        .section {
            margin: 20px 0;
        }

        .seal {
            margin-top: 40px;
            font-size: 0.9em;
        }

        .info-table {
            width: 100%;
            margin: 20px 0;
            font-size: 1.2em;
            text-align: left;
            line-height: 1.8;
        }

        .info-table td {
            padding: 5px 10px;
        }

        @media print {
            body {
                margin: 0;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="printAndRedirect();">
    <div class="certificate">
        <h2>ROMAN CATHOLIC DIOCESE OF MALOLOS</h2>
        <h1>Certificate of Baptism</h1>
        <p><strong>PAROKYA NG SAN JUAN BAUTISTA</strong></p>
        <p>San Juan, Hagonoy, Bulacan</p>

        <table class="info-table">
            <tr>
                <td><strong>Name of Groom:</strong></td>
                <td><?php echo $data['groom_name']; ?></td>
            </tr>
            <tr>
                <td><strong>Name of Bride:</strong></td>
                <td><?php echo $data['bride_name']; ?></td>
            </tr>
            <tr>
                <td><strong>Date of Marriage:</strong></td>
                <td><?php echo $data['date_married']; ?></td>
            </tr>
            <tr>
                <td><strong>Minister:</strong></td>
                <td>Rev. Fr. <?php echo $data['minister_name'] ?? 'Candido M. Pobre Jr.'; ?></td>
            </tr>
        </table>

        <p class="section">
            This transcript is a faithful copy from the Parish Baptismal Registry Book no.
            <strong><?php echo $data['book_number'] ?? 'VII'; ?></strong>,
            Page <strong><?php echo $data['page_number'] ?? '159'; ?></strong>,
            Line <strong><?php echo $data['line_number'] ?? '06'; ?></strong>,
            and in witness hereof, the undersigned affixed his signature and the parish seal.
        </p>

        <div class="seal">
            <p>Given at the Parish Office this <?php echo date('jS'); ?> day of <?php echo date('F'); ?>, <?php echo date('Y'); ?> for _______________ purposes.</p>
            <p><strong>Parish Seal</strong></p>
            <p>Rev. Fr. Melchor R. Ignacio</p>
            <p>Parish Priest</p>
        </div>
    </div>


    <script>
        function printAndRedirect() {
            window.print();
            setTimeout(function() {
                window.location.href = 'adminWeddingRecords.php';
            }, 1000); // Wait for 1 second to allow the print dialog to appear
        }
    </script>
</body>

</html>