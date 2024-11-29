<?php
session_start();
// session_unset();
unset($_SESSION['superAdminUsername']);
// session_destroy();
// ob_clean();
header("Location: superAdminLogin.php");
exit();
?>