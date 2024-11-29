<?php
session_start();
//session_unset();
unset($_SESSION['username']);
//session_destroy();
//ob_clean();
header("Location: userLogin.php");
exit();
?>