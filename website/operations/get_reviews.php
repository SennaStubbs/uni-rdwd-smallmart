<?php

    define('ALLOW_ACCESS', true);

    include($_SERVER['DOCUMENT_ROOT'] . "/smallmart/website/inc/dbconnect.php");
    include($_SERVER['DOCUMENT_ROOT'] . "/smallmart/website/inc/functions.php");

    if (isset($_POST['product-id']) && isset($_POST['offset'])) {
        $_productId = (int)$_POST['product-id'];
        $_offset = (int)$_POST['offset'];

        $stmt = "SELECT review_id, review_title, review_text, review_published_datetime, review_rating, user_id
                 FROM review
                 WHERE product_id = ?
                 ORDER BY review_published_datetime DESC
                 LIMIT 3
                 OFFSET ?";
        $sql = $dbconnect->prepare($stmt);
        $sql->bind_param('ii', $_productId, $_offset);
        $sql->execute();
        $review_results = $sql->get_result();

        if (mysqli_num_rows($review_results) > 0) {
            while($row = mysqli_fetch_assoc($review_results)) {
                include($_SERVER['DOCUMENT_ROOT'] . '/smallmart/website/inc/review.php');
            }
        }
    }
?>