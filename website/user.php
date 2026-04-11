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

		<!-- Page rows -->
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
                        <input id="user_display_name" name="user_display_name" required value="<?php echo $user_row['user_display_name'] ?>" maxlength="30" disabled>
                        <button class="change" type="button" onclick="StartChange(this)">Change</button>
                        <button class="submit hidden" type="button">Submit</button>
                        <button class="cancel hidden" type="button">Cancel</button>
                    </form>
                    <form id="email">
                        <label for="user_email">Email:</label>
                        <input id="user_email" name="user_email" type="email" required value="<?php echo $user_row['user_email'] ?>" maxlength="255" disabled>
                        <button class="change" type="button" onclick="StartChange(this)">Change</button>
                        <button class="submit hidden" type="button">Submit</button>
                        <button class="cancel hidden" type="button">Cancel</button>
                    </form>
                </div>
                <div class="tab-content hidden" id="tab-security">
                    <form id="password">
                        <label for="user_password">Current Password:</label>
                        <input id="user_password" name="user_password" type="password" required value="<?php echo str_repeat('#', strlen($user_row['user_password'] . $user_row['user_display_name'])); ?>" maxlength="255" disabled>
                        <button class="change" type="button" onclick="StartPasswordChange(this)">Change</button>
                    </form>
                    <form id="new_password" style="display: none;">
                        <label for="new_user_password">New Password:</label>
                        <input id="new_user_password" name="user_password" type="password" required value="<?php echo str_repeat('#', strlen($user_row['user_password'] . $user_row['user_display_name'])); ?>" maxlength="255" disabled>
                    </form>
                    <form id="confirm_password" style="display: none;">
                        <label for="confirm_user_password">Confirm New Password:</label>
                        <input id="confirm_user_password" name="user_password" type="password" required value="<?php echo str_repeat('#', strlen($user_row['user_password'] . $user_row['user_display_name'])); ?>" maxlength="255" disabled>
                        <button class="submit hidden" type="button">Submit</button>
                        <button class="cancel hidden" type="button">Cancel</button>
                    </form>
                </div>
            </div>
        </main>

		<!-- Footer -->
        <?php include("../website/inc/footer.php"); ?>

        <!-- JavaScript -->
        <script type="text/javascript" src="/smallmart/website/js/main.js"></script>
        <script type="text/javascript" src="/smallmart/website/js/user.js"></script>
    </body>
</html>