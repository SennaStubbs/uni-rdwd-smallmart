<?php
    define('ALLOW_ACCESS', true);

    if (session_status() === PHP_SESSION_NONE) {
		session_start();

        // Stop if not logged in
        if (!isset($_SESSION['user_id'])) {
            header('location: /smallmart/website/error');
            exit();
        }

        $userId = (int)$_SESSION['user_id'];

        if (isset($_POST['target-detail'])) {
            $targetDetail = htmlspecialchars($_POST['target-detail']);

            include('../../inc/dbconnect.php');

            if (isset($_POST[$targetDetail]) && $targetDetail != 'user_id' && $targetDetail != 'user_access_level') {

                switch ($targetDetail) {
                    case 'user_email':
                        $newValue = filter_var($_POST[$targetDetail], FILTER_SANITIZE_EMAIL);
                        $newValue = filter_var($_POST[$targetDetail], FILTER_VALIDATE_EMAIL);
                        if ($newValue == false) {
                            echo 'error:Invalid email.';
                        } else {
                            $stmt = "SELECT user_id FROM user WHERE user_email = ?";
                            $sql = $dbconnect->prepare($stmt);
                            $stmt = null;
                            $sql->bind_param('s', $newValue);
                            $sql->execute();
                            $email_result = $sql->get_result();
                            if (mysqli_num_rows($email_result) <= 1) {
                                $row = mysqli_fetch_assoc($email_result);
                                if (!isset($row['user_id']) || (isset($row['user_id']) && $row['user_id'] == $userId)) {
                                    $stmt = "UPDATE user SET user_email = ? WHERE user_id = ?";
                                }
                                else {
                                    echo 'error:Email already in use.';
                                }
                            }
                        }
                        break;
                    case 'user_display_name':
                        $newValue = htmlspecialchars($_POST[$targetDetail]);
                        $stmt = "UPDATE user SET user_display_name = ? WHERE user_id = ?";
                        break;
                    case 'user_password':
                        // $stmt = "UPDATE user SET user_password = '?' WHERE user_id = ?";
                        break;
                }

                if (isset($stmt)) {
                    $sql = $dbconnect->prepare($stmt);
                    $sql->bind_param('si', $newValue, $userId);
                    $sql->execute();

                    if ($sql->affected_rows > 0) {
                        echo 'success';
                    }
                    else {
                        echo 'duplicate';
                    }
                }
                else {
                    echo 'Something went wrong!';
                    exit();
                }
            } else {
                echo 'Something went wrong!';
                exit();
            }
        }
    }
?>