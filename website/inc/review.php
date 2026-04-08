<div class="review">
    <div class="title">
        <h1><?php echo $row['review_title'] ?></h1>
        <h2><?php echo date_format(datetime::createFromFormat('Y-m-d H:i:s', $row['review_published_datetime']), 'd/m/Y') ?></h2>
    </div>
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
            <?php }
        ?>
        <p><?php echo number_format($row['review_rating'], 1) ?></p>
    </div>
    <div class="divider"></div>
    <p class="review-text"><?php echo $row['review_text'] ?></p>
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
    <h3 class="reviewer"><?php echo $user_row['user_display_name'] ?></h3>
</div>