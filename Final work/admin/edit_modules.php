<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['id']) || $_SESSION['admin'] !== 'Y') {
    header('Location: ../login.php');
    exit();
}

try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    // Check for form submission
    if (isset($_POST['submit'])) {
        // Check if 'id' is set in the form
        if (isset($_POST['id'])) {
            // Get data from the form
            $moduleId = $_POST['id'];
            $moduleName = $_POST['ModuleName'];

            // Update the module
            editModule($pdo, $moduleId, $moduleName);

            // Redirect to the manage_modules page
            header('location: ../admin/manage_modules.php');
            exit();
        } else {
            $title = 'An error has occurred';
            $output = 'Invalid module ID';
        }
    } else {
        // If the form is not submitted, retrieve the question details
        $module = getModuleById($pdo, $_GET['id']);
        $title = 'Edit Module';

        // Output the HTML form
        ob_start();
        include '../templates/modules_edit.html.php';
        $output = ob_get_clean();
    }    
} catch (PDOException $e) {
    $title = 'Error has occurred';
    $output = 'Error editing module: ' . $e->getMessage();
}
include '../templates/adminlayout.html.php';
?>