<?php
    define('ALLOW_ACCESS', true);

    if (session_status() === PHP_SESSION_NONE) {
        session_start();

        include("../website/inc/dbconnect.php");

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
                            if (isset($split_variants)) {

                                $index = 1;
                                foreach ($split_variants[array_keys($split_variants)[$selected_variant != "" ? $selected_variant - 1 : 0]] as $v_image) {
                                    if ($index == 1 ) {?>
                        <button class="main-image-container">
                            <img class="image" src="<?php echo $v_image ?>" />
                        </button>
                                <?php } else { ?>
                        <button class="image-container">
                            <img class="image" src="<?php echo $v_image ?>" />
                        </button>
                                    <?php }
                                    $index++;
                                }

                                $index = 1;
                                foreach ($split_variants as $variant) {
                                    if (($index != $selected_variant && $selected_variant != "") || ($selected_variant == "" && $index != 1)) {
                                        foreach ($variant as $v_image) {?>
                        <button class="image-container">
                            <img class="image" src="<?php echo $v_image ?>" />
                        </button>
                                    <?php }
                                    }

                                    $index++;
                                }
                            }
                            else {
                                $index = 1;
                                foreach ($images as $image) {
                                    if ($index == 1) { ?>
                        <button class="main-image-container">
                            <img class="image" src="<?php echo $image ?>" />
                        </button>
                                    <?php } else { ?>
                        <button class="image-container">
                            <img class="image" src="<?php echo $image ?>" />
                        </button>
                                    <?php }

                                    $index++;
                                }
                            }
                            
                        ?>
                    </div>
                    <div class="product-info">
                        <h1><?php echo $product_row['product_name'] ?></h1>
                        <div class="rating">
                            <div class="star">
                                <span class="material-symbols-outlined star-outline">star</span>
                                <span class="material-symbols-outlined star-fill"
                                    style="clip-path: polygon(
                                        /* Starting points */
                                        29% 100%,
                                        29% 0%,
                                        /* Fill amounts */
                                        71% 0%,
                                        71% 100%
                                    );">
                                    star
                                </span>
                            </div>
                            <div class="star">
                                <span class="material-symbols-outlined star-outline">star</span>
                                <span class="material-symbols-outlined star-fill"
                                    style="clip-path: polygon(
                                        /* Starting points */
                                        29% 100%,
                                        29% 0%,
                                        /* Fill amounts */
                                        71% 0%,
                                        71% 100%
                                    );">
                                    star
                                </span>
                            </div>
                            <div class="star">
                                <span class="material-symbols-outlined star-outline">star</span>
                                <span class="material-symbols-outlined star-fill"
                                    style="clip-path: polygon(
                                        /* Starting points */
                                        29% 100%,
                                        29% 0%,
                                        /* Fill amounts */
                                        71% 0%,
                                        71% 100%
                                    );">
                                    star
                                </span>
                            </div>
                            <div class="star">
                                <span class="material-symbols-outlined star-outline">star</span>
                                <span class="material-symbols-outlined star-fill"
                                    style="clip-path: polygon(
                                        /* Starting points */
                                        29% 100%,
                                        29% 0%,
                                        /* Fill amounts */
                                        71% 0%,
                                        71% 100%
                                    );">
                                    star
                                </span>
                            </div>
                            <div class="star">
                                <span class="material-symbols-outlined star-outline">star</span>
                                <span class="material-symbols-outlined star-fill"
                                    style="clip-path: polygon(
                                        /* Starting points */
                                        29% 100%,
                                        29% 0%,
                                        /* Fill amounts */
                                        71% 0%,
                                        71% 100%
                                    );">
                                    star
                                </span>
                            </div>
                            <p>4.5 (150)</p>
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
            </div>
        </main>

		<!-- Footer -->
        <?php include("../website/inc/footer.php"); ?>

        <!-- JavaScript -->
        <script type="text/javascript" src="/smallmart/website/js/main.js"></script>
    </body>
</html>