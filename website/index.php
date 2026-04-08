<?php
    define('ALLOW_ACCESS', true);

    if (session_status() === PHP_SESSION_NONE) {
        session_start();

        include("../website/inc/dbconnect.php");
		include("../website/inc/functions.php");

		
		function LoadProducts($dbconnect, $categoryId) {
			$s1 = (string)$categoryId;
			$s2 = $categoryId . ',%';
			$s3 = '%,' . $categoryId;
			$s4 = '%,' . $categoryId . ',%';

			// Get all products and their 'featured' property, then order
			// by the featured value to limit appropriately
			$stmt = "SELECT *,
						CAST(
							SUBSTRING_INDEX(
								SUBSTRING_INDEX(product_details, 'featured=', -1),
								',', 1
							) AS UNSIGNED
						) AS featured_value
					FROM product
					WHERE category_id LIKE ? OR
			 			  category_id LIKE ? OR
			 			  category_id LIKE ? OR
			 			  category_id LIKE ?
					ORDER BY featured_value ASC
					LIMIT 10";
			$sql = $dbconnect->prepare($stmt);
			$sql->bind_param('ssss', $s1, $s2, $s3, $s4);
			$sql->execute();
			$prod_results = $sql->get_result();

			if (mysqli_num_rows($prod_results) > 0) {
				while($row = mysqli_fetch_assoc($prod_results)) {
					$details = $row['product_details'];
					include('inc/product_item.php');
				}
			}
		}
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home | Smallmart</title>
        <link rel="icon" type="image/png" href="/smallmart/website/assets/brand/small-logo.png">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="/smallmart/website/css/main.css">
    </head>
    <body>
        <!-- Navigation bar -->
        <?php include("../website/inc/navigation.php"); ?>

        <!-- Header -->
        <header class="home" style="background-image: url(/smallmart/website/assets/header.webp)">
            <div class="content">
                <p>Large sale for various miniature products! Up to 50% off!!</p>
                <a>Check it out!</a>
            </div>
        </header>

		<!-- Page rows -->
        <main class="rows">
			<!-- Collections -->
            <div class="row collections">
                <div class="container">
					<?php
						// Getting featured collections
						$stmt = "SELECT * FROM category";
						$sql = $dbconnect->prepare($stmt);
						$sql->execute();
						$collections_result = $sql->get_result();

						if (mysqli_num_rows($collections_result) > 0) {
							while($row = mysqli_fetch_assoc($collections_result)) {
								$details = $row['category_details'];
								include('../website/inc/split_details.php');
								if (isset($split_details)) {
									if (isset($split_details["featured"]) && (int)$split_details["featured"] > 0) { ?>
					<button onclick="ClickLink(event, '/smallmart/website/category?id=<?php echo $row['category_id'] ?>')" class="collection" style="order: <?php echo (int)$split_detail[1] ?>">
                        <div class="image" style="background-image: url(<?php echo $row['category_image'] ?>)"></div>
                        <div class="title">
                            <h1><?php echo $row['category_name'] ?></h1>
                            <a href="/smallmart/website/category?id=<?php echo $row['category_id'] ?>">View Collection</a>
                        </div>
					</button>
									<?php }
								}
							}
						}
					?>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="row-title">
                        <span class="material-symbols-outlined">star_shine</span>
                        FEATURED
                        <a href="/smallmart/website/category?id=8">View All</a>
                    </div>
                    <div class="products-container">
						<?php LoadProducts($dbconnect, 8); ?>
                    </div>
                </div>
            </div>
			<div class="row">
                <div class="container">
                    <div class="row-title">
                        <span class="material-symbols-outlined">stars</span>
                        NEWLY ADDED
                        <a href="/smallmart/website/category?id=9">View All</a>
                    </div>
                    <div class="products-container">
						<?php LoadProducts($dbconnect, 9); ?>
                    </div>
                </div>
            </div>
			<div class="row">
                <div class="container">
                    <div class="row-title">
                        <span class="material-symbols-outlined" style="width: 0.75em; margin-left: -0.25em">attach_money</span>
                        ON SALE
                        <a href="/smallmart/website/category?id=10">View All</a>
                    </div>
                    <div class="products-container">
						<?php LoadProducts($dbconnect, 10); ?>
                    </div>
                </div>
            </div>
			<div class="row">
                <div class="container">
                    <div class="row-title">
                        <span class="material-symbols-outlined">mode_comment</span>
                        RECENT REVIEWS
                    </div>
                    <div class="reviews-row-container">
						<?php
							// Get reviews
							$stmt = "SELECT review_id, review_title, review_text, review_published_datetime, review_rating, user_id, product_id
									 FROM review
									 ORDER BY review_published_datetime DESC
									 LIMIT 6"; // Order by newest -> oldest
							$sql = $dbconnect->prepare($stmt);
							$sql->execute();
							$reviews_result = $sql->get_result();

							if (mysqli_num_rows($reviews_result) > 0) {
								while ($row = mysqli_fetch_assoc($reviews_result)) {
									// Get product name
									$stmt = "SELECT product_name
											 FROM product
											 WHERE product_id = ?"; // Order by newest -> oldest
									$sql = $dbconnect->prepare($stmt);
									$sql->bind_param('i', $row['product_id']);
									$sql->execute();
									$product_result = $sql->get_result();
									$product_row = mysqli_fetch_assoc($product_result); ?>
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
							<?php }
							}
						?>
                    </div>
                </div>
            </div>
        </main>

		<!-- Footer -->
        <?php include("../website/inc/footer.php"); ?>

        <!-- JavaScript -->
        <script type="text/javascript" src="/smallmart/website/js/main.js"></script>
    </body>
</html>