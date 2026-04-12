<?php
    define('ALLOW_ACCESS', true);

    if (session_status() === PHP_SESSION_NONE) {
		session_start();

        // Stop if not logged in
        if (!isset($_SESSION['user_id'])) {
            header('location: /smallmart/website/error');
            exit();
        }

        function SillyException($e) {
            echo "error:Something went wrong!";
            exit();
        }
        set_exception_handler('SillyException');

        $userId = (int)$_SESSION['user_id'];

        if (isset($_POST['target-detail'])) {
            $targetDetail = htmlspecialchars($_POST['target-detail']);

            include('../../inc/dbconnect.php');

            if (isset($_POST[$targetDetail]) && $targetDetail != 'user_id' && $targetDetail != 'user_access_level') {

                switch ($targetDetail) {
                    case 'user_email':
                        $newValue = $_POST[$targetDetail];
                        if (trim($newValue) == "") {
                            echo 'error:Email must not be empty.';
                            exit();
                        }

                        $newValue = filter_var($newValue, FILTER_VALIDATE_EMAIL);
                        if ($newValue == false) {
                            echo 'error:Invalid email.';
                            exit();
                        } else {
                            $newValue = filter_var($newValue, FILTER_SANITIZE_EMAIL);

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
                                    exit();
                                }
                            }
                        }
                        break;
                    case 'user_display_name':
                        $newValue = $_POST[$targetDetail];

                        // Validation
                        if (trim($newValue) == "") {
                            echo "error:Display name must not be empty.";
                            exit();
                        }
                        if (mb_strlen($newValue) > 30) {
                            echo "error:Display name must be less than 30 characters long.";
                            exit();
                        }
                        if (preg_match('/[^a-zA-Z\d ]/', $newValue)) {
                            echo "error:Display name can only include letters, numbers and spaces.";
                            exit();
                        }

                        // Sanitisation
                        $newValue = trim(htmlspecialchars($newValue));
                        $stmt = "UPDATE user SET user_display_name = ? WHERE user_id = ?";
                        break;
                    case 'user_password':
                        $currentPassword = $_POST['user_password'];
                        $newPassword = $_POST['new_user_password'];
                        $confirmNewPassword = $_POST['confirm_user_password'];

                        // Validation
                        // Checking if current password is correct
                        $stmt = "SELECT user_password FROM user WHERE user_id = ?";
                        $sql = $dbconnect->prepare($stmt);
                        $sql->bind_param('i', $userId);
                        $sql->execute();
                        $user_result = $sql->get_result();
                        $row = mysqli_fetch_assoc($user_result);

                        if (password_verify($currentPassword, $row['user_password'])) {
                            // Check if new password is equal to the confirmed password
                            if ($newPassword == $confirmNewPassword) {
                                // Check if new password is not the same as the current / old password
                                if ($newPassword != $currentPassword) {
                                    // Getting password info
                                    $length = mb_strlen($newPassword);
                                    $lowercase = 0;
                                    $uppercase = 0;
                                    $numbers = 0;
                                    $symbols = 0;
                                    foreach (mb_str_split($newPassword) as $char) {
                                        if (preg_match('/[a-z]/', $char))
                                            $lowercase++;
                                        else if (preg_match('/[A-Z]/', $char))
                                            $uppercase++;
                                        else if (preg_match('/[\d]/', $char))
                                            $numbers++;
                                        else if (preg_match('/[^a-zA-Z\d]/', $char))
                                            $symbols++;
                                    }

                                    // Checking for invalidation
                                    $errors = [];
                                    $errorText = "New password must at least ";
                                    if ($length < 8)
                                        array_push($errors, "be 8 characters long");
                                    if ($lowercase < 1)
                                        array_push($errors, "have one lowercase letter");
                                    if ($uppercase < 1)
                                        array_push($errors, "have one uppercase letter");
                                    if ($numbers < 3)
                                        array_push($errors, "have three numbers");
                                    if ($symbols < 1)
                                        array_push($errors, "have one symbol");
                                    if ($length > 30) {
                                        if (count($errors) == 0)
                                            $errorText = "New password must ";
                                        array_push($errors, "be less than 30 characters long");
                                    }

                                    // Only run if there are no errors from validation
                                    if (count($errors) == 0) {
                                        $newValue = password_hash($newPassword, PASSWORD_DEFAULT);
                                        $stmt = "UPDATE user SET user_password = ? WHERE user_id = ?;";
                                    }
                                    else {
                                        // Output list of errors as readable text
                                        for ($i = 0; $i < count($errors); $i++) {
                                            if ($i > 0) {
                                                if ($i + 1 == count($errors))
                                                    $errorText = $errorText . ", and ";
                                                else
                                                    $errorText = $errorText . ", ";
                                            }
                                            $errorText = $errorText . $errors[$i];
                                        }

                                        echo "error:" . $errorText . ".";
                                        exit();
                                    }
                                }
                                else {
                                    echo "error: New password is the same as the current password.";
                                    exit();
                                }
                            }
                            else {
                                echo "error:Inputted 'new password' and 'confirmed new password' are not the same.";
                                exit();
                            }
                        }
                        else {
                            echo "error:Inputted 'current password' is incorrect.";
                            exit();
                        }

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
                        // New value is equal to current value
                        echo 'duplicate';
                    }
                }
                else {
                    echo 'error:Something went wrong!';
                    exit();
                }
            } else {
                echo 'error:Something went wrong!';
                exit();
            }
        }
    }
?>