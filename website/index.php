<?php
    define('ALLOW_ACCESS', true);

    if (session_status() === PHP_SESSION_NONE) {
        session_start();

        include("../website/inc/dbconnect.php");

		
		function LoadProducts($dbconnect, $categoryId) {
			$s1 = (string)$categoryId;
			$s2 = $categoryId . ',%';
			$s3 = '%,' . $categoryId;
			$s4 = '%,' . $categoryId . ',%';

			// Getting featured products
			$stmt = "SELECT * FROM product
						WHERE category_id LIKE ? OR
							category_id LIKE ? OR
							category_id LIKE ? OR
							category_id LIKE ?";
			$sql = $dbconnect->prepare($stmt);
			$sql->bind_param('ssss', $s1, $s2, $s3, $s4);
			$sql->execute();
			$prod_results = $sql->get_result();

			if (mysqli_num_rows($prod_results) > 0) {
				while($row = mysqli_fetch_assoc($prod_results)) {
					$details = explode(',', $row['product_details']);
					include('inc/product.php');
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
								$details = explode(',', $row['category_details']);

								foreach ($details as $detail) {
									$split_detail = preg_split("/=/", $detail, 2);
									if ($split_detail[0] == "featured" && (int)$split_detail[1] > 0) { ?>
					<div class="collection" style="order: <?php echo (int)$split_detail[1] ?>">
                        <div class="image" style="background-image: url(<?php echo $row['category_image'] ?>)"></div>
                        <div class="title">
                            <h1><?php echo $row['category_name'] ?></h1>
                            <a>View Collection</a>
                        </div>
                    </div>
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
                        <a>View All</a>
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
                        <a>View All</a>
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
                        <a>View All</a>
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
						<?php for ($i = 0; $i < 6; $i++) {
						echo '<div class="review">
							<a class="product-name">Guitar</a>
							<div class="title">
								<!-- Review title -->
								<h1>Might Mini Guitar</h1>
								<!-- Review published date -->
								<h2>11/2/26</h2>
							</div>
							<div class="divider"></div>
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
								<p>5<span>/5</span></p>
							</div>
							<p class="review-text">This tiny guitar prop is beautifully crafted with painted strings and a glossy body finish that gives it a premium feel. It...hat gives it a premiu</p>
							<div class="divider"></div>
							<p class="user">StrumBuddy</p>
						</div>'; } ?>
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