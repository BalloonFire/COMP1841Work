<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['id']) || $_SESSION['admin'] !== 'Y') {
    header('Location: ../login.php');
    exit();
}

include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

// Retrieve all admin messages from the database
$adminMessages = getAllAdminMessages($pdo);

$title = 'Admin Messages';
ob_start();
include '../templates/viewadminmessages.html.php';
$output = ob_get_clean();
include '../templates/adminlayout.html.php';
?>
