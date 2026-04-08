
<?php
    include('../website/inc/split_details.php');
?>

<?php if (isset($split_details["featured"])) {
    if ((int)$split_details["featured"]) { ?>
<div class="product" style="order: <?php echo $split_details["featured"] ?>">
    <?php } else { ?>
<div class="product" style="order: 999999999">
    <?php }
} else { ?>
<div class="product" style="order: 999999999">
<?php } ?>
    <div class="details">
        <div class="title">
            <!-- Product name -->
            <h1><?php echo $row['product_name'] ?></h1>
            <!-- Product price -->
            <?php if (isset($split_details["discounted-price"])) { ?>
            <h2><span class="og-price">£<?php echo number_format($row['product_price'] / 100, 2) ?></span>£<?php echo number_format($split_details["discounted-price"] / 100, 2) ?></h2>
            <?php } else { ?>
            <h2>£<?php echo number_format($row['product_price'] / 100, 2) ?></h2>
            <?php } ?>
        </div>
        <div class="bottom">
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
            <button class="favourite material-symbols-outlined">
                favorite
            </button>
        </div>
    </div>
    <div class="image-container">
        <div class="image" style="background-image: url(<?php echo explode(',', $row['product_image'], 2)[0] ?>)"></div>
    </div>
</div>