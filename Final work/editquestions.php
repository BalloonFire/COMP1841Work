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
    // Check for form submission
    if (isset($_POST['submit'])) {
        try {
            include 'includes/uploadFile.php';
    
            // Check if 'id' is set in the form
            if (isset($_POST['id'])) {
                // Get data from the form
                $id = $_POST['id'];
                $QTitle = $_POST['QTitle'];
                $QContent = $_POST['QContent'];
                $file = $_FILES['fileToUpload'];
                $uploadDirectory = "uploads/";
                $ModuleID = $_POST['ModuleID'];
    
                // Retrieve existing image path
                $existingQuestion = getQuestion($pdo, $id);
                $existingImagePath = $existingQuestion['image'];
    
                // Delete old image file
                if (!empty($existingImagePath) && file_exists($existingImagePath)) {
                    unlink($existingImagePath);
                }
    
                // Upload new image file
                $uploadedFilePath = uploadFile($file, $uploadDirectory);
    
                if ($uploadedFilePath !== false) {
                    // Update the question
                    updateQuestions($pdo, $id, $QContent, $QTitle, $uploadedFilePath, $ModuleID);
    
                    // Redirect to the questions list
                    header('location: questions.php');
                    exit();
                } else {
                    $title = 'An error has occurred';
                    $allowedFormats = 'JPG, JPEG, PNG, GIF';
                    $output = "Sorry! Your picture is not in the following formats: $allowedFormats.";
                }
            } else {
                $title = 'An error has occurred';
                $output = 'Invalid question ID';
            }
        } catch (PDOException $e) {
            $title = 'Error has occurred';
            $output = 'Error editing questions: ' . $e->getMessage();
        }
    } else {
        // If the form is not submitted, retrieve the question details
        $questions = getQuestion($pdo, $_GET['id']);
        $modules = allModules($pdo);
        $title = 'Edit questions';

        // Output the HTML form
        ob_start();
        include 'templates/editquestions.html.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'Error has occurred';
    $output = 'Error editing questions: ' . $e->getMessage();
}

// Include the layout template
include 'templates/layout.html.php';
?>
