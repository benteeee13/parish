<?php
include 'userSessionStart.php';

if (!isset($_SESSION['username'])) {
    header("Location: userLogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Parish of San Juan</title>
        <link rel="stylesheet" href="userWeddingSchedule2.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script>
            function btnback(event) {
                event.preventDefault();
                window.location.href = "userScheduleApplication.php";
            }
            function btnapplication(event) {
                event.preventDefault();
                window.location.href = "userWeddingApplication.php";
            }
        </script>
    </head>
    <body>
        <?php include 'userHeader.php'; ?>
        <div id="mainDiv">
            <div id="forLabel">
                <a href="#" id="weddingScheduleLabel" class="label">Wedding Schedule</a>
            </div>
            <div id="sched" class="d-flex flex-column">
                <div id="forPicAndSched" class="d-flex">
                    <div id="pic"></div>
                <div id="schedList">
                        <p id="monthLabel" class="forLabel">Month of <?php echo date('F Y'); ?></p>
                        <div class="dateContainer">
                            <a href="userWeddingAvailableSchedule.php" class="sampleDate">"check the available schedule."</a>
                        </div>
                    </div>
                </div>
                    <p id="moreInfo1" class="reqInfo">Requirements:</p>
                    <p id="moreInfo2" class="reqInfo">Canonical Interview at least one month before the wedding</p>
                    <p id="moreInfo3" class="reqInfo">New Baptismal and Confirmation Certificate with the annotation  for marriage</p>
                    <p id="moreInfo4" class="reqInfo">Marriage License, or if civilly married, Marriage Contract with registry number</p>
                    <p id="moreInfo5" class="reqInfo">₱1000.00 deposit upon application (not refundable)</p>
                    <p id="moreInfo6" class="reqInfo">Pre-Cana Seminar: 1 Sunday</p>
                    <p id="moreInfo7" class="reqInfo">Filled Up Application Form (Download link available a the bottm of this page)</p>
                    <div id="buttonsDiv">
                    <button id="btnApplication" type="button" class="btn btn-success" onclick="btnapplication(event)">Application</button>
                    <button id="btnBack" type="button" class="btn btn-danger" onclick="btnback(event)">Back</button>
                </div>
            </div>
        </div>
    </body>
</html>
