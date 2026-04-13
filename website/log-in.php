<?php
    define('ALLOW_ACCESS', true);

    if (session_status() === PHP_SESSION_NONE) {
        session_start();

        include("../website/inc/dbconnect.php");
		include("../website/inc/functions.php");

        // Redirect if already logged in
        if (isset($_SESSION['user_id'])) {
            header('location: user.php');
            exit();
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Log In | Smallmart</title>
        <link rel="icon" type="image/png" href="/smallmart/website/assets/brand/small-logo.png">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="/smallmart/website/css/main.css">
        <link rel="stylesheet" type="text/css" href="/smallmart/website/css/log-in.css">
    </head>
    <body>
        <!-- Navigation bar -->
        <?php include("../website/inc/navigation.php"); ?>

		<!-- Log in panel -->
        <main class="center-page log-in">
			<div class="container">
				<form id="log-in" name="log-in">
					<label for="email" name="email">Email</label>
					<input id="email" name="email" type="email" placeholder="Enter email here..." required>
					<label for="password" name="password">Password</label>
					<div>
					    <input id="password" name="password" type="password" placeholder="Enter password here..." maxlength="30" required>
                        <button tabindex="-1" type="button" class="visibility material-symbols-outlined" onclick="ToggleInputVisibility(this, event)">visibility</button>
                    </div>
				</form>
                <p class="hidden" id="error-message"></p>
				<p>Don't have an account? <a href="/smallmart/website/sign-up">Sign up here!</a></p>
				<button form="log-in" type="button" onclick="LogIn(event)">LOG IN</button>
			</div>
        </main>

		<!-- Footer -->
        <?php include("../website/inc/footer.php"); ?>

        <!-- JavaScript -->
        <script type="text/javascript" src="/smallmart/website/js/main.js"></script>
        <script type="text/javascript" src="/smallmart/website/js/log-in.js"></script>
    </body>
</html>