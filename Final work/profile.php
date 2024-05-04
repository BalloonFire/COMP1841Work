<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

// Retrieve the current user ID, username, and email from the session
$userId = $_SESSION['id'];
$userEmail = $_SESSION['Email'];
$userUsername = $_SESSION['Username'];

// Retrieve user details from the database
$userDetails = getUserDetails($pdo, $userId);

// Check if user details are available
if ($userDetails) {
    $title = 'User Profile';
    $output = "User ID: $userId <br> Username: $userUsername <br> Email: $userEmail";
} else {
    $title = 'An error has occurred';
    $output = 'Unable to retrieve user details.';
}
ob_start();
include 'templates/profile.html.php';
$output = ob_get_clean();
include 'templates/layout.html.php';
?>
