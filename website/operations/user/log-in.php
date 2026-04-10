<?php
	define('ALLOW_ACCESS', true);

    if (session_status() === PHP_SESSION_NONE) {
		session_start();

        // Stop if already logged in
        if (isset($_SESSION['user_id'])) {
            exit();
        }
		
		if (isset($_POST['email']) && isset($_POST['password']) &&
            trim(htmlspecialchars($_POST['email'])) != "" && trim(htmlspecialchars($_POST['password'])) != "") {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            include("../../inc/dbconnect.php");

            $stmt = "SELECT * FROM user WHERE user_email = ?";
            $sql = $dbconnect->prepare($stmt);
            $sql->bind_param('s', $email);
            $sql->execute();
            $result = $sql->get_result();

            if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
                    $hashed_password = $row['user_password'];

                    // Check if inputted password matches the stored password hash
					if (password_verify($password, $hashed_password)) {
						$_SESSION['user_id'] = $row['user_id'];

						echo 'success';
					}
					else {
                        $error = true;
					}
                }
            } else {
                $error = true;
            }
            
            if (isset($error)) {
                // Ambiguous invalid message
                echo "error:Invalid email or password.";
            }
        } else {
            if (!isset($_POST['email']) || trim(htmlspecialchars($_POST['email'])) == "")
                echo "error:No email submitted.";

            if (!isset($_POST['password']) || trim(htmlspecialchars($_POST['password'])) == "")
                echo "error:No password submitted.";
        }
    }
?>