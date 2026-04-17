<?php

    define('ALLOW_ACCESS', true);

    include("../inc/dbconnect.php");
    include("../inc/functions.php");

    if (isset($_POST['offset'])) {
        $_offset = (int)$_POST['offset'];

        $stmt = "SELECT *
                 FROM review
                 ORDER BY review_published_datetime DESC
                 LIMIT 6
                 OFFSET ?";
        $sql = $dbconnect->prepare($stmt);
        $sql->bind_param('i', $_offset);
        $sql->execute();
        $review_results = $sql->get_result();

        if (mysqli_num_rows($review_results) > 0) {
            while($row = mysqli_fetch_assoc($review_results)) {
                // Get product name
                $stmt = "SELECT product_name
                            FROM product
                            WHERE product_id = ?"; // Order by newest -> oldest
                $sql = $dbconnect->prepare($stmt);
                $sql->bind_param('i', $row['product_id']);
                $sql->execute();
                $product_result = $sql->get_result();
                $product_row = mysqli_fetch_assoc($product_result);

                include('../inc/home_review.php');
            }
        }
    }
?>