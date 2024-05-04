<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

try {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunctions.php';

    // Check if the form has been submitted
    if (isset($_POST['confirm_delete'])) {
        // Proceed with the deletion process
        $deletedQuestion = getQuestion($pdo, $_POST['id']);
        deleteQuestions($pdo, $_POST['id']);

        // Delete the image file if it exists
        if (file_exists($deletedQuestion['image'])) {
            unlink($deletedQuestion['image']);
        }

        // Redirect to questions page
        header('Location: questions.php');
        exit();
    } else {
        // If form not submitted, show the warning message
        ob_start();
        include 'templates/deletequestions.html.php';
        $output = ob_get_clean();
        $title = 'Delete Question';
        include 'templates/layout.html.php';
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Unable to connect to delete questions: ' . $e->getMessage();
    include 'templates/layout.html.php';
}
?>
