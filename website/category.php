<?php
    define('ALLOW_ACCESS', true);

    if (session_status() === PHP_SESSION_NONE) {
        session_start();

        include("../website/inc/dbconnect.php");

		// $sql = 'SELECT * FROM product;';
		// $stmt = $dbconnect -> prepare($sql);
		// $stmt -> execute();
        // $product_result = $stmt->get_result();
		include("../website/inc/pagination.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>{category_name} | Smallmart</title>
        <link rel="icon" type="image/png" href="/smallmart/website/assets/brand/small-logo.png">
        <!-- Google Material Symbols -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL,GRAD@100..700,0..1,100&icon_names=account_circle,attach_money,blender,chevron_right,close,delete,favorite,filter_alt,fork_spoon,house,keyboard_arrow_down,keyboard_arrow_up,menu,mode_comment,mood,music_note_2,nature,search,star,star_shine,stars,stars_2,sunny,visibility&display=block" />
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="/smallmart/website/css/main.css">
    </head>
    <body>
        <!-- Navigation bar -->
        <?php include("../website/inc/navigation.php"); ?>

        <!-- Header -->
        <header style="background-image: url(/smallmart/website/assets/header.webp)">
			<div class="bg-colour" style="background-color: #0077FF"></div>
            <h1 class="title" style="background-color: #027ADC; box-shadow: 0px 5px 0px #0035BA">CATEGORY</h1>
        </header>

        <main>
            <div class="grid-spacer">
				<div class="numbers">
					<p class="page-no">Page <b><?php echo $page; ?></b> of <b><?php echo $total_pages; ?></b></p>
					<p class="product-no">Showing <b><?php echo max(0, min(1, mysqli_num_rows($product_result))) + $offset; ?> - <?php echo mysqli_num_rows($product_result) + $offset; ?></b> of <b><?php echo $total_products; ?></b> products</p>
				</div>
				<div class="sort-by">
					<label>Sort by</label>
					<select>
						<option>Featured</option>
						<option>Most Popular</option>
						<option>Name: A-Z</option>
						<option>Name: Z-A</option>
						<option>Price: Low-High</option>
						<option>Price: High-Low</option>
						<option>Oldest</option>
						<option>Newest</option>
					</select>
				</div>
			</div>
			<div class="products-grid-main">
				<div class="products-filters">
					<a><span class="material-symbols-outlined">keyboard_arrow_right</span>FEATURED</a>
					<a><span>•</span>Newly Added</a>
					<a><span>•</span>On Sale</a>
					<a><span>•</span>Popular</a>
					<div class="divider"></div>
					<a><span>•</span>Food</a>
					<a><span>•</span>Musical Instruments</a>
					<a><span>•</span>Kitchen Collection</a>
					<a><span>•</span>Foliage</a>
					<a><span>•</span>House Furniture</a>
					<a><span>•</span>Outdoor Furniture</a>
					<a><span>•</span>Miscellaneous</a>
				</div>
				<div class="products-section">
					<div class="products-grid">
						<?php
							if (mysqli_num_rows($product_result) > 0) {
								while($row = mysqli_fetch_assoc($product_result)) { ?>
									<div class="product">
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
								<?php }
							}
						?>
					</div>
					<p class="product-no">Showing <b><?php echo max(0, min(1, mysqli_num_rows($product_result))) + $offset; ?> - <?php echo mysqli_num_rows($product_result) + $offset; ?></b> of <b><?php echo $total_products; ?></b> products</p>
					<div class="pagination">
						
						<a class="direction prev <?php if ($page <= 1): ?>hidden<?php endif; ?>" href="?page=<?php echo $page - 1; ?>">PREV</a>
						

						<?php for ($i = 1; $i <= $total_pages; $i++): ?>
							<a class="number <?php if ($i === $page) echo 'active'; ?>" href="?page=<?php echo $i; ?>">
								<?php echo $i; ?>
							</a>
						<?php endfor; ?>

						<a class="direction next <?php if ($page >= $total_pages): ?>hidden<?php endif; ?>" href="?page=<?php echo $page + 1; ?>">NEXT</a>
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