<?php
session_start();

// Redirect to the login page if not logged in
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}
include 'includes/DatabaseConnection.php';

$userID = $_SESSION['id'];
$username = $_SESSION['Username'];

$title = 'Student Question Forum';
ob_start();
include 'templates/home.html.php';
$output = ob_get_clean();
include 'templates/layout.html.php';
?>
