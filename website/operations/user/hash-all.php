<?php
	define('ALLOW_ACCESS', false);
    exit();


    include("../../inc/dbconnect.php");

    $stmt = "SELECT user_id, user_password FROM user";
    $sql = $dbconnect->prepare($stmt);
    $sql->execute();
    $all_results = $sql->get_result();
    while($row = mysqli_fetch_assoc($all_results)) {
        echo $row['user_id'] . ' ' . $row['user_password'] . '<br>';

        $hashed_password = password_hash($row['user_password'], PASSWORD_DEFAULT);
        echo $hashed_password . '<br><br>';

        $stmt = "UPDATE user SET user_password = ? WHERE user_id = ?";
        $sql = $dbconnect->prepare($stmt);
        $sql->bind_param('si', $hashed_password, $row['user_id']);
        $sql->execute();
    }
?>