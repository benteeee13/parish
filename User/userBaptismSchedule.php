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
        <link rel="stylesheet" href="userBaptismSchedule4.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script>
            function btnback(event) {
                event.preventDefault();
                window.location.href = "userScheduleApplication.php";
            }
            function btnapplication(event) {
                event.preventDefault();
                window.location.href = "userBaptismApplication.php";
            }
        </script>
    </head>
    <body>
        <?php include 'userHeader.php'; ?>
        <div id="mainDiv">
            <div id="forLabel">
                <a href="#" id="baptismScheduleLabel" class="label">Baptism Schedule</a>
            </div>
            <div id="sched" class="d-flex flex-column">
                <div id="forPicAndSched" class="d-flex">
                    <div id="pic">
                        
                    </div>
                    <div id="schedList">
                        <p id="monthLabel" class="forLabel">Month of <?php echo date('F Y'); ?></p>
                        <div class="dateContainer">
                            <a href="userBaptismAvailableSchedule.php" class="sampleDate">"check the available schedule."</a>
                        </div>
                    </div>
                </div>
                    <p id="moreInfo1" class="reqInfo">Requirements:</p>
                    <p id="moreInfo2" class="reqInfo">Birth Certificate with registry number (PSA or Local Civil Registry)</p>
                    <p id="moreInfo3" class="reqInfo">Baptismal Certificate of Parents</p>
                    <p id="moreInfo4" class="reqInfo">Permission letter from your Parish Church (if outside the vicinity of Santuario)</p>
                    <p id="moreInfo5" class="reqInfo">Baptismal Fee - ₱300.00 (to be paid on seminar date)</p>
                    <div id="buttonsDiv">
                    <button id="btnApplication" type="button" class="btn btn-success" onclick="btnapplication(event)">Application</button>
                    <button id="btnBack" type="button" class="btn btn-danger" onclick="btnback(event)">Back</button>
                </div>
            </div>
        </div>
    </body>
</html>
