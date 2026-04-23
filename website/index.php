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
					include('inc/templates/product_item.php');
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
        <link rel="stylesheet" type="text/css" href="/smallmart/website/css/home.css">
    </head>
    <body>
        <!-- Navigation bar -->
        <?php include("../website/inc/navigation.php"); ?>

        <!-- Header -->
        <header class="home" style="background-image: url(/smallmart/website/assets/misc/header.webp)">
            <div class="content">
                <p>Large sale for various miniature products! Up to 50% off!!</p>
                <a href="/smallmart/website/category.php?id=10" class="animate-button-5px"><span>Check it out!</span></a>
            </div>
        </header>

		<!-- Page rows -->
        <main class="rows">
			<!-- Collections -->
            <div class="row collections">
                <div id="collections-container" class="container">
					<?php
						// Getting featured collections
						$stmt = "SELECT * FROM category";
						$sql = $dbconnect->prepare($stmt);
						$sql->execute();
						$collections_result = $sql->get_result();

						$index = 1;
						if (mysqli_num_rows($collections_result) > 0) {
							while($row = mysqli_fetch_assoc($collections_result)) {
								$details = $row['category_details'];
								$split_details = SplitDetails($details);
								if (isset($split_details["featured"]) && (int)$split_details["featured"] > 0) { ?>
				<button id="collection-<?php echo $index ?>" onauxclick="ClickLink(event, '/smallmart/website/category?id=<?php echo $row['category_id'] ?>')"
					onclick="ClickLink(event, '/smallmart/website/category?id=<?php echo $row['category_id'] ?>')"
					class="collection animate-button-5px" style="order: <?php echo (int)$split_detail[1] ?>">
					<div class="image" style="background-image: url(<?php echo $row['category_image'] ?>)"></div>
					<div class="title">
						<h1><?php echo $row['category_name'] ?></h1>
						<a class="animate-button-2px" href="/smallmart/website/category?id=<?php echo $row['category_id'] ?>"><span>View Collection</span></a>
					</div>
				</button>
								<?php
									$index++;
								}
							}
						}
					?>
                </div>
				<div class="slide-buttons">
					<?php for ($i = 1; $i <= $index - 1; $i++) { ?>
					<button id="collection-button-<?php echo $i ?>" onclick="MoveCategorySlide(<?php echo $i ?>)" class="<?php echo $i == 1 ? 'selected' : '' ?>"></button>
					<?php } ?>
				</div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="row-title">
                        <span class="material-symbols-outlined">star_shine</span>
                        <span>FEATURED</span>
                        <a href="/smallmart/website/category?id=8" class="animate-button-5px"><span>View All</span></a>
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
                        <span>NEWLY ADDED</span>
                        <a href="/smallmart/website/category?id=9" class="animate-button-5px"><span>View All</span></a>
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
                        <span>ON SALE</span>
                        <a href="/smallmart/website/category?id=10" class="animate-button-5px"><span>View All</span></a>
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
                        <span>RECENT REVIEWS</span>
                    </div>
                    <div id="reviews-row-container">
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
									$product_row = mysqli_fetch_assoc($product_result);

									include('inc/templates/home_review.php');
						
								}
							}
						?>
						<button id="load-more-reviews" onclick="LoadMoreRecentReviews()" class="animate-button-5px"><span>Load More Reviews</span></button>
                    </div>
                </div>
            </div>
        </main>

		<!-- Footer -->
        <?php include("../website/inc/footer.php"); ?>

        <!-- JavaScript -->
        <script type="text/javascript" src="/smallmart/website/js/main.js"></script>
        <script type="text/javascript" src="/smallmart/website/js/home.js"></script>
    </body>
</html>