<?php
    define('ALLOW_ACCESS', true);

    if (session_status() === PHP_SESSION_NONE) {
		session_start();

        if (isset($_SESSION['user_id'])) {
            $userId = (int)$_SESSION['user_id'];

            include("../../inc/dbconnect.php");
            include("../../inc/functions.php");

            // Get user information
            $stmt = "SELECT * FROM user WHERE user_id = ?";
            $sql = $dbconnect->prepare($stmt);
            $sql->bind_param('i', $userId);
            $sql->execute();
            $user_result = $sql->get_result();

            if (mysqli_num_rows($user_result) > 0) {
                $user_row = mysqli_fetch_assoc($user_result);

                if (isset($_POST['product-id'])) {
                    $productId = (int)$_POST['product-id'];

                    // Check if product is real
                    $stmt = "SELECT * FROM product WHERE product_id = ?";
                    $sql = $dbconnect->prepare($stmt);
                    $sql->bind_param('i', $productId);
                    $sql->execute();
                    $product_result = $sql->get_result();

                    if (mysqli_num_rows($product_result) > 0) {
                        // Get user's wishlist
                        $stmt = "SELECT * FROM wishlist_product WHERE user_id = ? AND product_id = ?";
                        $sql = $dbconnect->prepare($stmt);
                        $sql->bind_param('ii', $userId, $productId);
                        $sql->execute();
                        $wishlist_result = $sql->get_result();

                        if (mysqli_num_rows($wishlist_result) > 0) {
                            // Remove from wishlist
                            $wishlist_row = mysqli_fetch_assoc($wishlist_result);
                            $wishlist_id = $wishlist_row['wishlist_prod_id'];

                            $stmt = "DELETE FROM wishlist_product
                                    WHERE wishlist_prod_id = ?";
                            $sql = $dbconnect->prepare($stmt);
                            $sql->bind_param('i', $wishlist_id);
                            $sql->execute();

                            if ($sql->affected_rows > 0) {
                                echo 'removed';
                                exit();
                            }
                            else {
                                echo 'error';
                                exit();
                            }
                        }
                        else {
                            // Add to wishlist
                            $stmt = "INSERT INTO wishlist_product (user_id, product_id)
                                    VALUES (?, ?)";
                            $sql = $dbconnect->prepare($stmt);
                            $sql->bind_param('ii', $userId, $productId);
                            $sql->execute();

                            if ($sql->affected_rows > 0) {
                                echo 'added';
                                exit();
                            }
                            else {
                                echo 'error';
                                exit();
                            }
                        }
                    }
                    else {
                        echo 'error';
                        exit();
                    }
                }                
            }
            else {
                // Something is wrong
                echo 'log-out';
                exit();
            }
        } else {
            // Redirect them to the login page
            echo 'log-in';
            exit();
        }
    }
?>