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
        <title>User Account | Smallmart</title>
        <link rel="icon" type="image/png" href="/smallmart/website/assets/brand/small-logo.png">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="/smallmart/website/css/main.css">
    </head>
    <body>
        <!-- Navigation bar -->
        <?php include("../website/inc/navigation.php"); ?>

		<!-- Main contents -->
        <main class="user">
			<h1 class="welcome">Hello, <?php echo $user_row['user_display_name'] ?>!</h1>
            <div class="divider"></div>
            <div class="container">
                <div id="tabs">
                    <button class="selected" data-tab="account">Account</button>
                    <button data-tab="security">Security</button>
                </div>
                <div class="vertical-divider"></div>
                <div class="tab-content" id="tab-account">
                    <form id="display-name">
                        <label for="user_display_name">Display name:</label>
                        <input id="user_display_name" name="user_display_name" required maxlength="30" value="<?php echo $user_row['user_display_name'] ?>" maxlength="30" disabled>
                        <button class="change" type="button" onclick="StartChange(this)">Change</button>
                        <button class="submit hidden" type="button">Submit</button>
                        <button class="cancel hidden" type="button">Cancel</button>
                        <p class="error-message hidden"></p>
                    </form>
                    <form id="email">
                        <label for="user_email">Email:</label>
                        <input id="user_email" name="user_email" type="email" required value="<?php echo $user_row['user_email'] ?>" maxlength="255" disabled>
                        <button class="change" type="button" onclick="StartChange(this)">Change</button>
                        <button class="submit hidden" type="button">Submit</button>
                        <button class="cancel hidden" type="button">Cancel</button>
                        <p class="error-message hidden"></p>
                    </form>
                </div>
                <div class="tab-content hidden" id="tab-security">
                    <form id="password">
                        <label for="user_password">Password:</label>
                        <div>
                            <input id="user_password" name="user_password" type="password" required value="<?php echo str_repeat('#', 100); ?>" maxlength="30" disabled>
                            <button tabindex="-1" type="button" class="visibility material-symbols-outlined hidden" onclick="ToggleInputVisibility(this, event)">visibility</button>
                        </div>
                        <button class="change" type="button" onclick="StartChange(this)">Change</button>
                    </form>
                    <form id="new_password" class="hidden">
                        <label for="new_user_password">New password:</label>
                        <div>
                            <input id="new_user_password" name="new_user_password" type="password" required value="" maxlength="30">
                            <button tabindex="-1" type="button" class="visibility material-symbols-outlined" onclick="ToggleInputVisibility(this, event)">visibility</button>
                        </div>
                    </form>
                    <form id="confirm_password" class="hidden">
                        <label for="confirm_user_password">Confirm new password:</label>
                        <div>
                            <input id="confirm_user_password" name="confirm_user_password" type="password" required value="" maxlength="30">
                            <button tabindex="-1" type="button" class="visibility material-symbols-outlined" onclick="ToggleInputVisibility(this, event)">visibility</button>
                        </div>
                        <button class="submit hidden" type="button">Submit</button>
                        <button class="cancel hidden" type="button">Cancel</button>
                        <p class="error-message hidden"></p>
                    </form>
                </div>
            </div>
            <button id="log-out" onclick="window.location.href='/smallmart/website/operations/user/log-out'">LOG OUT</button>
        </main>

		<!-- Footer -->
        <?php include("../website/inc/footer.php"); ?>

        <!-- JavaScript -->
        <script type="text/javascript" src="/smallmart/website/js/main.js"></script>
        <script type="text/javascript" src="/smallmart/website/js/user.js"></script>
    </body>
</html>