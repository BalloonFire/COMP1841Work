<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['id'])) {
    header('Location: Login.php');
    exit();
}

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

// Retrieve the current user ID and hashed password from the session
$userId = $_SESSION['id'];
$currentUserPassword = $_SESSION['Password'];

// Retrieve user details from the database
$userDetails = getUserDetails($pdo, $userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form submission for updating profile
    $newUsername = $_POST['newUsername'];
    $newEmail = $_POST['newEmail'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];

    // Check if the old password matches the current user's hashed password
    if (hash('sha256', $oldPassword) === $currentUserPassword) {
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

                // Update the session variable with the new hashed password
                $_SESSION['Password'] = $hashedNewPassword;

                // Redirect to the profile page after a successful update
                header('Location: profile.php');
                exit();
            }
        } catch (PDOException $e) {
            $error = 'Error updating profile: ' . $e->getMessage();
        }
    } else {
        $error = 'Old password does not match. Please try again.';
    }
}

ob_start();
include 'templates/editprofile.html.php';
$output = ob_get_clean();
$title = 'Edit Profile';
include 'templates/layout.html.php';
?>
