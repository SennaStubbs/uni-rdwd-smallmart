<?php
    define('ALLOW_ACCESS', true);

    if (session_status() === PHP_SESSION_NONE) {
		session_start();

        if (isset($_SESSION['user_id'])) {
            $user_id = (int)$_SESSION['user_id'];

            include("../website/inc/dbconnect.php");
            include("../website/inc/functions.php");


            // Get user information
            $stmt = "SELECT * FROM user WHERE user_id = ?";
            $sql = $dbconnect->prepare($stmt);
            $sql->bind_param('i', $user_id);
            $sql->execute();
            $user_result = $sql->get_result();

            if (mysqli_num_rows($user_result) > 0) {
                $user_row = mysqli_fetch_assoc($user_result);
            }
            else {
                // Something is wrong with the user account, forcefully log them out
                header('location: /smallmart/website/operations/user/log-out');
                exit();
            }
        } else {
            // Redirect them to the login page
            header('location: log-in.php');
            exit();
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Wishlist | Smallmart</title>
        <link rel="icon" type="image/png" href="/smallmart/website/assets/brand/small-logo.png">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="/smallmart/website/css/main.css">
    </head>
    <body>
        <!-- Navigation bar -->
        <?php include("../website/inc/navigation.php"); ?>

        <main class="">
			
        </main>

		<!-- Footer -->
        <?php include("../website/inc/footer.php"); ?>

        <!-- JavaScript -->
        <script type="text/javascript" src="/smallmart/website/js/main.js"></script>
    </body>
</html>