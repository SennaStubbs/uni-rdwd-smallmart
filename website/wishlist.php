<?php
    define('ALLOW_ACCESS', true);

    if (session_status() === PHP_SESSION_NONE) {
		session_start();

        if (isset($_SESSION['user_id'])) {
            $user_id = (int)$_SESSION['user_id'];

            include("inc/dbconnect.php");
            include("inc/functions.php");


            // Get user information
            $stmt = "SELECT * FROM user WHERE user_id = ?";
            $sql = $dbconnect->prepare($stmt);
            $sql->bind_param('i', $user_id);
            $sql->execute();
            $user_result = $sql->get_result();

            if (mysqli_num_rows($user_result) > 0) {
                include('inc/wishlist_pagination.php');
                $reload = true;
            } else {
                // Something is wrong with the user account, forcefully log them out
                header('location: /smallmart/website/operations/user/log-out');
                exit();
            }
        } else {
            // Redirect them to the login page
            header('location: log-in?redirect=wishlist');
            exit();
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Wishlist | Smallmart</title>
        <link rel="icon" type="image/png" href="/smallmart/website/assets/brand/small-logo.png">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="/smallmart/website/css/main.css">
        <link rel="stylesheet" type="text/css" href="/smallmart/website/css/wishlist.css">
    </head>
    <body>
        <!-- Navigation bar -->
        <?php include("../website/inc/navigation.php"); ?>

        <main class="wishlist">
			<div class="container">
                <?php
                    
                ?>
                <h1 class="title">YOUR WISHLIST <span>(<?php echo $total_products ?> items)</span></h1>
                <div class="products-grid">
                    <?php
                        if (mysqli_num_rows($wishlist_result) > 0) {
                            while ($wishlist_row = mysqli_fetch_assoc($wishlist_result)) {
                                $productId = $wishlist_row['product_id'];

                                // Get product info
                                $stmt = "SELECT * FROM product WHERE product_id = ?";
                                $sql = $dbconnect->prepare($stmt);
                                $sql->bind_param('i', $productId);
                                $sql->execute();
                                $product_result = $sql->get_result();
                                $row = mysqli_fetch_assoc($product_result);

                                $details = $row['product_details'];
					            include('inc/product_item.php');
                            } ?>
                </div>
                <p class="product-no">Showing <b><?php echo max(0, min(1, mysqli_num_rows($wishlist_result))) + $offset; ?> - <?php echo mysqli_num_rows($wishlist_result) + $offset; ?></b> of <b><?php echo $total_products; ?></b> products</p>
                <div class="pagination">
                    <a class="direction prev <?php if ($page <= 1): ?>hidden<?php endif; ?> animate-button-2px" href="?<?php
                        echo http_build_query(array(
                            'page' => $page - 1
                        )) ?>"><span>PREV</span></a>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a class="number <?php if ($i === $page) echo 'active'; ?> animate-button-2px" href="?<?php
                        echo http_build_query(array(
                            'page' => $i
                        )) ?>">
                            <span><?php echo $i; ?></span>
                        </a>
                    <?php endfor; ?>
                    <a class="direction next <?php if ($page >= $total_pages): ?>hidden<?php endif; ?> animate-button-2px" href="?<?php
                        echo http_build_query(array(
                            'page' => $page + 1
                        )) ?>"><span>NEXT</span></a>
                </div>
                    <?php } else { ?>
                </div>
                <p class="empty-wishlist">You have no products in your wishlist!<br>Check out the <a href="/smallmart/website/category?id=8">featured</a> products of <strong>Smallmart</strong>.</p>
                    <?php } ?>
            </div>
        </main>

		<!-- Footer -->
        <?php include("../website/inc/footer.php"); ?>

        <!-- JavaScript -->
        <script type="text/javascript" src="/smallmart/website/js/main.js"></script>
    </body>
</html>