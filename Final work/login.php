<?php
session_start();
$loginFailed = false;

if (isset($_POST['login'])) {
    try {
        include 'includes/DatabaseConnection.php';
        include 'includes/DatabaseFunctions.php';

        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = 'SELECT * FROM users WHERE Username = :username';
        $parameters = [':username' => $username];
        $stmt = query($pdo, $sql, $parameters);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && hash('sha256', $password) === $user['Password']) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['Username'] = $user['Username'];
            $_SESSION['Email'] = $user['Email'];
            $_SESSION['Password'] = $user['Password'];
            $_SESSION['admin'] = $user['admin'];
            // Redirect based on admin status
            if ($user['admin'] === 'Y') {
                header('Location: ../admin/admin.php');
            } else {
                header('Location: index.php');
            }
        } else {
            $title = 'Login';
            $loginFailed = true;
            ob_start();
            include 'templates/login.html.php';
            $output = ob_get_clean();
        }        
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $errorMessage = 'Database error: ' . $e->getMessage();
        ob_start();
        include 'templates/login.html.php';
        $output = ob_get_clean();
    }
} else {
    $title = 'Login';
    ob_start();
    include 'templates/login.html.php';
    $output = ob_get_clean();
}

include 'templates/layout_menu.html.php';
?>
