<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['QContent'])) {
    try {
        include 'includes/DatabaseConnection.php';
        include 'includes/DatabaseFunctions.php';
        include 'includes/uploadFile.php';

        $file = $_FILES['fileToUpload'];
        $uploadDirectory = "uploads/";

        $uploadedFilePath = uploadFile($file, $uploadDirectory);

        if ($uploadedFilePath !== false) {
            // File upload successful, now insert question into the database
            insertQuestions(
                $pdo,
                $_POST['QTitle'],
                $_POST['QContent'],
                $uploadedFilePath,
                $_SESSION['id'],
                $_POST['ModuleID']
            );

            header('location: questions.php');
        } else {
            $title = 'An error has occurred';
            $allowedFormats = 'JPG, JPEG, PNG, GIF';
            $output = "Sorry! You either have picture duplicate or is not in the following formats: $allowedFormats.";
        }
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
} else {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunctions.php';
    $title = 'Insert New Question Here';
    $modules = allModules($pdo);
    $users = allUsers($pdo);
    ob_start();
    include 'templates/addquestions.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';
?>
