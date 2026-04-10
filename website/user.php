<?php
    define('ALLOW_ACCESS', true);

    if (session_status() === PHP_SESSION_NONE) {
		session_start();
        if (isset($_SESSION['user_id'])) {
            echo 'user id: ' . $_SESSION['user_id'];
        } else {
            // Redirect them to the login page
            header('log-in.php');
        }
    }
?>