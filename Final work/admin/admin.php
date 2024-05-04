<?php
session_start();

// Redirect to the login page if not logged in
if (!isset($_SESSION['id']) || $_SESSION['admin'] !== 'Y') {
    header('Location: ../login.php');
    exit();
}
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

$userID = $_SESSION['id'];
$username = $_SESSION['Username'];

$allUsers = allUsers($pdo);

$title = 'Student Question Admin Forum';
ob_start();
include '../templates/adminhome.html.php';
$output = ob_get_clean();
include '../templates/adminlayout.html.php';
?>
