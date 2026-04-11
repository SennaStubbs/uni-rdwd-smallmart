<?php
    define('ALLOW_ACCESS', true);

    if (session_status() === PHP_SESSION_NONE) {
        session_start();

        include("../website/inc/dbconnect.php");
		include("../website/inc/functions.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Log In | Smallmart</title>
        <link rel="icon" type="image/png" href="/smallmart/website/assets/brand/small-logo.png">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="/smallmart/website/css/main.css">
    </head>
    <body>
        <!-- Navigation bar -->
        <?php include("../website/inc/navigation.php"); ?>

		<!-- Page rows -->
        <main class="center-page log-in">
            <h1>WELCOME, NEW USER!</h1>
			<div class="container">
				<form id="sign-up" name="sign-up">
					<label for="email" name="email">Email</label>
					<input id="email" name="email" type="email" placeholder="Enter email here..." required>
					<label for="password" name="password">Password</label>
                    <div>
					    <input id="password" name="password" type="password" placeholder="Enter password here..." required>
                        <button type="button" class="visibility material-symbols-outlined" onclick="ToggleInputVisibility(this)">visibility</button>
                    </div>
                    <label for="confirm-password" name="confirm-password">Confirm Password</label>
                    <div>
					    <input id="confirm-password" name="confirm-password" type="password" placeholder="Enter password here..." required>
                        <button type="button" class="visibility material-symbols-outlined" onclick="ToggleInputVisibility(this)">visibility</button>
                    </div>
				</form>
                <p class="hidden" id="error-message"></p>
				<p>Already have an account? <a href="/smallmart/website/log-in">Log in here!</a></p>
				<button form="sign-up" type="submit" onclick="SignUp()">SIGN UP</button>
			</div>
        </main>

		<!-- Footer -->
        <?php include("../website/inc/footer.php"); ?>

        <!-- JavaScript -->
        <script type="text/javascript" src="/smallmart/website/js/main.js"></script>
        <script type="text/javascript" src="/smallmart/website/js/log-in.js"></script>
    </body>
</html>