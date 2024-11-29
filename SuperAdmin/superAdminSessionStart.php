<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start session if it's not already active
}
?>