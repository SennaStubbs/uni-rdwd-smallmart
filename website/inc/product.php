<?php if (isset($split_detail)): ?>
<div class="product" style="order: <?php echo $split_detail[0] == "featured" && (int)$split_detail[1] > 0 ? $split_detail[1] : '' ?>">
<?php else: ?>
<div class="product">
<?php endif ?>
    <div class="details">
        <div class="title">
            <!-- Product name -->
            <h1><?php echo $row['product_name'] ?></h1>
            <!-- Product price -->
            <h2>£<?php echo number_format($row['product_price'] / 100, 2) ?></h2>
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
        <div class="image" style="background-image: url(<?php echo $row['product_image'] ?>)"></div>
    </div>
</div>