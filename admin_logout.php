<?php
session_start();

// Verify if the admin session exists
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}
?>
