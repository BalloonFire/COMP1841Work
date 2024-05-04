<?php
session_start();
if (isset($_POST['register'])) {
    try {
        include 'includes/DatabaseConnection.php';
        include 'includes/DatabaseFunctions.php';

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $hashedPassword = hash('sha256', $password);

        // Check if the username already exists
        $checkUsernameQuery = 'SELECT COUNT(*) FROM Users WHERE Username = :username';
        $checkUsernameParameters = [':username' => $username];
        $checkUsernameStmt = query($pdo, $checkUsernameQuery, $checkUsernameParameters);
        $usernameExists = $checkUsernameStmt->fetchColumn();

        if ($usernameExists) {
            $title = 'An error has occurred';
            $output = 'Username already exists. Please choose a different username.';
        } else {
            $insertUserQuery = 'INSERT INTO Users (Username, Email, Password, admin) VALUES (:username, :email, :password, :admin)';
            $insertUserParameters = [
                ':username' => $username,
                ':email' => $email,
                ':password' => $hashedPassword,
                ':admin' => "N"
            ];
            
            $insertUserStmt = query($pdo, $insertUserQuery, $insertUserParameters);

            if ($insertUserStmt->rowCount() > 0) {
                header('location: login.php');
            } else {
                $title = 'An error has occurred';
                $output = 'Registration failed. Please try again.';
            }
        }
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
} else {
    $title = 'Register';
    ob_start();
    include 'templates/register.html.php';
    $output = ob_get_clean();
}
include 'templates/layout_menu.html.php';
?>
