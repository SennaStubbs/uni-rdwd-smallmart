<div class="review">
    <a class="product-name" href="/smallmart/website/product.php?id=<?php echo $row['product_id'] ?>"><?php echo $product_row['product_name'] ?></a>
    <div class="title">
        <!-- Review title -->
        <h1><?php echo $row['review_title'] ?></h1>
        <!-- Review published date -->
        <h2><?php echo date_format(datetime::createFromFormat('Y-m-d H:i:s', $row['review_published_datetime']), 'd/m/Y') ?></h2>
    </div>
    <div class="divider"></div>
    <div class="rating">
        <?php
            // Set star fills
            for ($index = 0; $index < 5; $index++) {
                $starValue = Clamp($row['review_rating'] - $index, 0, 1);
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
            <?php } ?>
        <p><?php echo $row['review_rating'] ?><span>/5</span></p>
    </div>
    <p class="review-text"><?php echo substr($row['review_text'], 0, 147) . '...' ?></p>
    <div class="divider"></div>
    <?php
        // Get review user
        $stmt = "SELECT user_display_name
                    FROM user
                    WHERE user_id = ?";
        $sql = $dbconnect->prepare($stmt);
        $sql->bind_param('i', $row['user_id']);
        $sql->execute();
        $user_result = $sql->get_result();
        $user_row = mysqli_fetch_assoc($user_result);
    ?>
    <p class="user"><?php echo $user_row['user_display_name'] ?></p>
</div>