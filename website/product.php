<?php
    define('ALLOW_ACCESS', true);

    if (session_status() === PHP_SESSION_NONE) {
        session_start();

        include("../website/inc/dbconnect.php");
        include("../website/inc/functions.php");

        // Getting product
		$productId = isset($_GET['id']) ? (int)$_GET['id'] : -1;
        $selected_variant = isset($_GET['variant']) ? (int)$_GET['variant'] : "";
        $stmt = "SELECT * FROM product WHERE product_id = ?";
        $sql = $dbconnect->prepare($stmt);
        $sql->bind_param('i', $productId);
        $sql->execute();
        $product_result = $sql->get_result();
        if (mysqli_num_rows($product_result) > 0) { 
            $product_row = mysqli_fetch_assoc($product_result);

            $images = explode(',', $product_row['product_image']);

            $details = $product_row['product_details'];
            include('../website/inc/split_details.php');

            // Getting variants
            if (isset($split_details['variants'])) {
                // echo $split_details['variants'];
                $variant_title = preg_replace('/"(.*?)":{.*?}/', '$1', $split_details['variants']);
                // foreach ($variants_title as $vari) {
                //     echo $vari;
                // }
                $variants = preg_replace('/".*?":{(.*?)}/', '$1', $split_details['variants']);
                $variants = preg_split('/","/', $variants);

                if ($selected_variant > 0 && $selected_variant <= count($variants) || $selected_variant == "") {
                    $split_variants = [];
                    foreach ($variants as $variant) {
                        $split_variant = preg_split("/:/", preg_replace('/"/', '', $variant), 2);
                        if (isset($split_variant[0]) && isset($split_variant[1])) {
                            $split_variants[$split_variant[0]] = explode(',', $split_variant[1]);
                        }
                    }
                }
                else {
                    header('location: error');
                    exit;
                }
            }
            else if ($selected_variant != "") {
                header('location: error');
                exit;
            }
        } else {
            header('location: error');
            exit;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $product_row['product_name'] ?> | Smallmart</title>
        <link rel="icon" type="image/png" href="/smallmart/website/assets/brand/small-logo.png">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="/smallmart/website/css/main.css">
    </head>
    <body>
        <!-- Navigation bar -->
        <?php include("../website/inc/navigation.php"); ?>

		<!-- Page rows -->
        <main class="product-page">
            <div class="main-container">
                <div class="container">
                    <div class="images">
                        <?php
                            $allImages = [];

                            if (isset($split_variants)) {

                                $index = 1;
                                $imageIndex = 0;
                                foreach ($split_variants[array_keys($split_variants)[$selected_variant != "" ? $selected_variant - 1 : 0]] as $v_image) {
                                    if ($index == 1 ) {?>
                        <button class="main-image-container" onclick="OpenImageViewer(<?php echo $imageIndex ?>)">
                            <img class="image" src="<?php echo $v_image ?>" />
                        </button>
                                <?php } else { ?>
                        <button class="image-container" onclick="OpenImageViewer(<?php echo $imageIndex ?>)">
                            <img class="image" src="<?php echo $v_image ?>" />
                        </button>
                                    <?php }
                                    $index++;
                                    $imageIndex++;
                                    array_push($allImages, $v_image);
                                }

                                $index = 1;
                                foreach ($split_variants as $variant) {
                                    if (($index != $selected_variant && $selected_variant != "") || ($selected_variant == "" && $index != 1)) {
                                        foreach ($variant as $v_image) {?>
                        <button class="image-container" onclick="OpenImageViewer(<?php echo $imageIndex ?>)">
                            <img class="image" src="<?php echo $v_image ?>" />
                        </button>
                                    <?php
                                            $imageIndex++;
                                            array_push($allImages, $v_image);
                                        }
                                    }

                                    $index++;
                                }
                            }
                            else {
                                $index = 1;
                                foreach ($images as $image) {
                                    if ($index == 1) { ?>
                        <button class="main-image-container" onclick="OpenImageViewer(<?php echo $index - 1 ?>)">
                            <img class="image" src="<?php echo $image ?>" />
                        </button>
                                    <?php } else { ?>
                        <button class="image-container" onclick="OpenImageViewer(<?php echo $index - 1 ?>)">
                            <img class="image" src="<?php echo $image ?>" />
                        </button>
                                    <?php }

                                    $index++;
                                    array_push($allImages, $image);
                                }
                            }
                            
                        ?>
                    </div>
                    <div class="product-info">
                        <h1><?php echo $product_row['product_name'] ?></h1>
                        <div class="rating">
                            <?php
                                // Get overall review ratings
                                // Get reviews
                                $stmt = "SELECT COUNT(*) as totalCount, AVG(review_rating) as avgRating
                                        FROM review
                                        WHERE product_id = ?";
                                $sql = $dbconnect->prepare($stmt);
                                $sql->bind_param('i', $productId);
                                $sql->execute();
                                $totalReviews_Result = $sql->get_result();

                                $totalReviews_Row = mysqli_fetch_assoc($totalReviews_Result);

                                // Stars
                                for ($index = 0; $index < 5; $index++) {
                                    $starValue = Clamp($totalReviews_Row['avgRating'] - $index, 0, 1);
                                    $starFillValue = $starValue * (71 - 29); ?>
                            <div class="star">
                                <span class="material-symbols-outlined star-outline">star</span>
                                <span class="material-symbols-outlined star-fill"
                                    style="clip-path: polygon(
                                        /* Starting points */
                                        29% 100%,
                                        29% 0%,
                                        /* Fill amounts */
                                        <?php echo 29 + $starFillValue; ?>% 0%,
                                        <?php echo 29 + $starFillValue; ?>% 100%
                                    );">
                                    star
                                </span>
                            </div>
                            <?php } ?>
                            
                            <p><?php echo number_format($totalReviews_Row['avgRating'], '1')?> (<?php echo $totalReviews_Row['totalCount'] ?>)</p>
                        </div>
                        <?php //if (isset($split_details["discounted-price"])) { ?>
                        <!-- <h2><span class="og-price">£<?php //echo number_format($product_row['product_price'] / 100, 2) ?></span>£<?php //echo number_format($split_detail[1] / 100, 2) ?></h2> -->
                        <?php //} else { ?>
                        <h2>£<?php echo number_format($product_row['product_price'] / 100, 2) ?></h2>
                        <?php //} ?>
                        <?php if (isset($variants)): ?>
                        <div class="variants">
                            <h3><?php echo $variant_title ?></h3>
                            <div class="variants-grid">
                                <?php
                                    $index = 1;
                                    foreach ($split_variants as $key=>$value) { ?>
                                        <a <?php if ($selected_variant == $index || ($selected_variant == "" and $index == 1)) { echo 'class="selected"'; } else { echo 'href="/smallmart/website/product?id=' . $productId . '&variant=' . $index . '"'; } ?>>
                                            <?php echo $key ?>
                                        </a>
                                        <?php
                                        $index++;
                                    }
                                ?>
                            </div>
                        </div>
                        <?php endif ?>
                        <button class="add-to-wishlist"><span class="material-symbols-outlined">favorite</span>Add to wishlist</button>
                        <div class="divider"></div>
                        <p><?php echo $product_row['product_description'] ?></p>
                    </div>
                </div>
                <div class="divider"></div>
                <div id="reviews">
                    <?php
                        // Get reviews
                        $stmt = "SELECT review_id, review_title, review_text, review_published_datetime, review_rating, user_id
                                 FROM review
                                 WHERE product_id = ?
                                 ORDER BY review_published_datetime DESC
                                 LIMIT 3"; // Order by newest -> oldest
                        $sql = $dbconnect->prepare($stmt);
                        $sql->bind_param('i', $productId);
                        $sql->execute();
                        $reviews_result = $sql->get_result();
                    ?>
                    <h1 class="title">Reviews (<?php echo $totalReviews_Row['totalCount'] ?>)</h1>
                    <?php
                        if (mysqli_num_rows($reviews_result) > 0) {
							while($row = mysqli_fetch_assoc($reviews_result)) {
                                include('../website/inc/review.php');
                            }
                        } else { ?>
                        <h1 id="no-reviews">This product has no reviews.</h1>
                    <?php } ?>
                    <button id="load-more-reviews" onclick="LoadMoreReviews()">LOAD MORE REVIEWS</button>
                </div>
                <div class="divider"></div>
                <div class="related-products">
                    <h1 class="row-title">Related Products</h1>
                    <div class="products-container">
                        <?php
                            // Load related products (in the same category and
                            // uses first word in the product name for similar products)
                            $stmt = "SELECT *
                                    FROM product
                                    WHERE (category_id LIKE SUBSTRING_INDEX(category_id, ',', 1) OR
                                        category_id LIKE CONCAT(SUBSTRING_INDEX(category_id, ',', 1), ',%') OR
                                        category_id LIKE CONCAT(',%', SUBSTRING_INDEX(category_id, ',', 1)) OR
                                        category_id LIKE CONCAT('%,', SUBSTRING_INDEX(category_id, ',', 1), ',%') OR
                                        product_name LIKE CONCAT('%', SUBSTRING_INDEX(product_name, ' ', 1), '%'))
                                        AND product_id <> ?
                                    LIMIT 5"; // Could possibly order by sales(? if added later)
                            $sql = $dbconnect->prepare($stmt);
                            $sql->bind_param('i', $productId);
                            $sql->execute();
                            $prod_results = $sql->get_result();

                            if (mysqli_num_rows($prod_results) > 0) {
                                while($row = mysqli_fetch_assoc($prod_results)) {
                                    $details = $row['product_details'];
                                    include('inc/product_item.php');
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </main>

        <!-- Product image viewer -->
        <div id="image-viewer" class="hidden">
            <div class="close">
                <button class="material-symbols-outlined" onclick="CloseImageViewer()">close</button>
            </div>
            <div id="viewer-main-image">
                <img src="/smallmart/website/assets/header.webp">
            </div>
            <!-- Other images available to view -->
            <div id="viewer-images">
                <div class="counter">
                    <p>0 of 0</p>
                </div>
            </div>
        </div>

		<!-- Footer -->
        <?php include("../website/inc/footer.php"); ?>

        <?php
            // Assigning PHP variables to JavaScript variables
        ?>
        <script>
            var productId = <?php echo $productId ?>;
            var totalReviewsCount = <?php echo $totalReviews_Row['totalCount'] ?>;

            var imagesList = [<?php
                $index = 1;
                foreach ($allImages as $image) {
                    echo "'" . $image . "'" . ($index < count($allImages) ? "," : "");
                    $index++;
                }
            ?>];
        </script>

        <!-- JavaScript -->
        <script type="text/javascript" src="/smallmart/website/js/main.js"></script>
        <script type="text/javascript" src="/smallmart/website/js/product-page.js"></script>
    </body>
</html>