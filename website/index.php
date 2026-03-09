<?php
    define('ALLOW_ACCESS', true);

    if (session_status() === PHP_SESSION_NONE) {
        session_start();

        include("../website/inc/dbconnect.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home | Smallmart</title>
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="/website/css/main.css">
    </head>
    <body>


        <!-- JavaScript -->
        <script type="text/javascript" src="/website/js/main.js"></script>
    </body>
</html>