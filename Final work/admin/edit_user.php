<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['id']) || $_SESSION['admin'] !== 'Y') {
    header('Location: ../login.php');
    exit();
}

include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

// Retrieve the user ID from the URL parameter
$userId = $_GET['id'] ?? null;

// Check if the user ID is not provided or invalid
if (!$userId) {
    $error = 'User ID is missing or invalid.';
    // Display the error message directly in the page
    echo "<p>$error</p>";
    exit();
}

// Fetch user details from the database
$userDetails = getUserDetails($pdo, $userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form submission for updating profile
    $newUsername = $_POST['newUsername'];
    $newEmail = $_POST['newEmail'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];

    // Check if the old password matches the current user's hashed password
    if (hash('sha256', $oldPassword) === $userDetails['Password']) {
        try {
            // Check if the new username is already used by another user
            $checkUsernameQuery = 'SELECT COUNT(*) FROM Users WHERE Username = :username';
            $checkUsernameParameters = [':username' => $newUsername];
            $checkUsernameStmt = query($pdo, $checkUsernameQuery, $checkUsernameParameters);
            $usernameExists = $checkUsernameStmt->fetchColumn();

            if ($usernameExists) {
                $error = 'Username already exists. Please choose a different username.';
            } else {
                // Hash the new password
                $hashedNewPassword = hash('sha256', $newPassword);

                // Update user details in the database
                updateProfile($pdo, $userId, $newUsername, $newEmail, $hashedNewPassword);

                // Redirect to the user table page after a successful update
                header('Location: ../admin/user_table.php');
                exit();
            }
        } catch (PDOException $e) {
            $error = 'Error updating profile: ' . $e->getMessage();
        }
    } else {
        $error = 'Old password does not match. Please try again.';
    }
}

$title = 'Edit Profile';
ob_start();
include '../templates/edit_user.html.php';
$output = ob_get_clean();
include '../templates/adminlayout.html.php';
?>
