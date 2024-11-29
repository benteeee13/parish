<?php
session_start();
//session_unset();
unset($_SESSION['adminUsername']);
//session_destroy();
//ob_clean();
header("Location: adminLogin.php");
exit();
?>