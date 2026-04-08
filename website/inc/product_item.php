
<?php
    include('../website/inc/split_details.php');

    // Get review ratings
    $stmt = "SELECT COUNT(review_id) as review_count, AVG(review_rating) review_average
            FROM review
            WHERE product_id = ?";
    $sql = $dbconnect->prepare($stmt);
    $sql->bind_param('i', $row['product_id']);
    $sql->execute();
    $review_results = $sql->get_result();
    $review_row = mysqli_fetch_assoc($review_results);
?>

<?php if (isset($split_details["featured"])) {
    if ((int)$split_details["featured"]) { ?>
<div class="product" style="order: <?php echo $split_details["featured"] ?>" onclick="window.location.href = '/smallmart/website/product.php?id=<?php echo $row['product_id'] ?>'">
    <?php } else { ?>
<div class="product" style="order: 999999999" onclick="window.location.href = '/smallmart/website/product.php?id=<?php echo $row['product_id'] ?>'">
    <?php }
} else { ?>
<div class="product" style="order: 999999999" onclick="window.location.href = '/smallmart/website/product.php?id=<?php echo $row['product_id'] ?>'">
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
                <?php
            // Set star fills
            for ($index = 0; $index < 5; $index++) {
                $starValue = Clamp($review_row['review_average'] - $index, 0, 1);
                $starFillValue = $starValue * (71 - 29);
                ?>
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
            <?php }
        ?>
        <p><?php echo number_format($review_row['review_average'], 1) ?> (<?php echo $review_row['review_count'] ?>)</p>
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