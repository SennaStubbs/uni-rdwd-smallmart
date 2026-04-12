<?php
	define('ALLOW_ACCESS', true);

    // echo 'error:';

    if (session_status() === PHP_SESSION_NONE) {
		session_start();

        function SillyException($e) {
            echo $e;
            exit();
        }
        set_exception_handler('SillyException');

        // Stop if already logged in
        if (isset($_SESSION['user_id'])) {
            header('location: /smallmart/website/user');
            echo "success";
            exit();
        }		
		if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) &&
            trim(htmlspecialchars($_POST['email'])) != "" && trim(htmlspecialchars($_POST['password'])) != ""
            && trim(htmlspecialchars($_POST['confirm_password'])) != "") {
                
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($email && $password && $confirm_password) {
                include("../../inc/dbconnect.php");

                //Check if 'email' already exists
                $stmt = "SELECT user_id FROM user WHERE user_email = ?";
                $email_sql = $dbconnect->prepare($stmt);
                $email_sql->bind_param('s', $email);
                $email_sql->execute();
                $email_results = $email_sql->get_result();

                if (mysqli_num_rows($email_results) > 0) {
                    echo "error:Email is already in use!";
                    exit();
                }

                // Check if 'password' and 'confirm_password' are the same
                if ($password == $confirm_password) {
                    // Validating password
                    // Getting password info
                    $length = strlen($password);
                    $lowercase = 0;
                    $uppercase = 0;
                    $numbers = 0;
                    $symbols = 0;
                    foreach (mb_str_split($password) as $char) {
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
                    $errorText = "Password must at least ";
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
                            $errorText = "Password must ";
                        array_push($errors, "be less than 30 characters long");
                    }

                    // Only run if there are no errors from validation
                    if (count($errors) == 0) {
                        $user_display_name = ucwords(strtolower(preg_replace('/@.*/', '', $email)));
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        $stmt = "INSERT INTO user (user_email, user_display_name, user_password, user_access_level)
                                 VALUES (?, ?, ?, 0);";
                        $sql = $dbconnect->prepare($stmt);
                        $sql->bind_param('sss', $email, $user_display_name, $hashed_password);
                        $sql->execute();
                        $insert_result = $sql->get_result();

                        if ($sql->affected_rows > 0) {
                            $stmt = "SELECT user_id FROM user WHERE user_email = ?";
                            $sql = $dbconnect->prepare($stmt);
                            $sql->bind_param('s', $email);
                            $sql->execute();
                            $select_result = $sql->get_result();

                            $row = mysqli_fetch_assoc($select_result);

                            $_SESSION['user_id'] = $row['user_id'];

                            echo "success";
                            exit();
                        } else {
                            echo "error:Something went wrong!";
                            exit();
                        }
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
                    echo "error:Inputted password and confirmed password do not match.";
                    exit();
                }
            } else {
                echo "error:Invalid email.";
                exit();
            }
        } else {
            if (!isset($_POST['email']) || trim(htmlspecialchars($_POST['email'])) == "")
                echo "error:No email submitted.";

            if (!isset($_POST['password']) || trim(htmlspecialchars($_POST['password'])) == ""
                || !isset($_POST['confirm_password']) || trim(htmlspecialchars($_POST['confirm_password'])) == "")
                echo "error:No password submitted.";
            
            exit();
        }
    }
?>