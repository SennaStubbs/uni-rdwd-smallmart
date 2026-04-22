<?php
    define('ALLOW_ACCESS', true);

    if (session_status() === PHP_SESSION_NONE) {
        session_start();

        include("../website/inc/dbconnect.php");
		include("../website/inc/functions.php");

		// $sql = 'SELECT * FROM product;';
		// $stmt = $dbconnect -> prepare($sql);
		// $stmt -> execute();
        // $product_result = $stmt->get_result();
		include("../website/inc/pagination.php");
    }

	// Get category information
	$stmt = "SELECT *
			FROM category
			WHERE category_id = ?";
	$sql = $dbconnect->prepare($stmt);
	$sql->bind_param('i', $categoryId);
	$sql->execute();
	$category_result = $sql->get_result();
	if (mysqli_num_rows($category_result) > 0) {
		// Only using the first row found
		$category_row = mysqli_fetch_assoc($category_result);

		$details = $category_row['category_details'];
		include('../website/inc/split_details.php');
		$category_details = isset($split_details) ? $split_details : [];
		
	} else {
		header('location: error');
		exit;
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $category_row['category_name'] ?> | Smallmart</title>
        <link rel="icon" type="image/png" href="/smallmart/website/assets/brand/small-logo.png">
        <!-- Google Material Symbols -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL,GRAD@100..700,0..1,100&icon_names=account_circle,attach_money,blender,chevron_right,close,delete,favorite,filter_alt,fork_spoon,house,keyboard_arrow_down,keyboard_arrow_up,menu,mode_comment,mood,music_note_2,nature,search,star,star_shine,stars,stars_2,sunny,visibility&display=block" />
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="/smallmart/website/css/main.css">
        <link rel="stylesheet" type="text/css" href="/smallmart/website/css/products-grid.css">
    </head>
    <body>
        <!-- Navigation bar -->
        <?php include("../website/inc/navigation.php"); ?>

        <!-- Header -->
        <header style="background-image: url(/smallmart/website/assets/header.webp)">
			<?php if (isset($category_details['bg_col']) && isset($category_details['button_col']) && isset($category_details['button_acc_col']) && isset($category_details['text_col'])): ?>
			<div class="bg-colour" style="background-color: <?php echo $category_details['bg_col'] ?>"></div>
            <h1 class="title" style="background-color: <?php echo $category_details['button_col'] ?>;
									 box-shadow: 0px 5px 0px <?php echo $category_details['button_acc_col'] ?>;
									 color: <?php echo $category_details['text_col'] ?>">
				<?php echo strtoupper($category_row['category_name']) ?>
			</h1>
			<?php else: ?>
			<div class="bg-colour"></div>
            <h1 class="title"><?php echo strtoupper($category_row['category_name']) ?></h1>
			<?php endif ?>
        </header>

		<!-- Main contents -->
        <main>
            <div class="grid-spacer">
				<div class="numbers">
					<button class="filters-dropdown-button" data-dropdown-id="filters-dropdown-menu" onclick="ToggleDropdown(this)"><span class="material-symbols-outlined">filter_alt</span><span>FILTERS</span></button>
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
					<?php
						// Get categories that have 'main_category=true' in their details
						$stmt = "SELECT *
								FROM category
								WHERE SUBSTRING_INDEX(
										SUBSTRING_INDEX(category_details, 'main_category=', -1),
										',', 1) = 'true'";
						$sql = $dbconnect->prepare($stmt);
						$sql->execute();
						$main_cate_results = $sql->get_result();

						if (mysqli_num_rows($main_cate_results) > 0) {
							while($row = mysqli_fetch_assoc($main_cate_results)) { ?>
					<a href="/smallmart/website/category?id=<?php echo $row['category_id'] ?>">
						<?php echo $row['category_id'] == $categoryId ?
						'<span class="material-symbols-outlined">keyboard_arrow_right</span>' . strtoupper($row['category_name'])
						:
						'<span>•</span>' . $row['category_name']; ?>
					</a>
						<?php }
						}
					?>
					<div class="divider"></div>
					<?php
						// Get categories that do not have 'main_category=true' in their details
						$stmt = "SELECT *
								FROM category
								WHERE SUBSTRING_INDEX(
										SUBSTRING_INDEX(category_details, 'main_category=', -1),
										',', 1) != 'true'";
						$sql = $dbconnect->prepare($stmt);
						$sql->execute();
						$category_result = $sql->get_result();
						
						if (mysqli_num_rows($category_result) > 0) {
							while($row = mysqli_fetch_assoc($category_result)) { ?>
						<a href="/smallmart/website/category?id=<?php echo $row['category_id'] ?>">
							<?php echo $row['category_id'] == $categoryId ?
							'<span class="material-symbols-outlined">keyboard_arrow_right</span>' . strtoupper($row['category_name'])
							:
							'<span>•</span>' . $row['category_name']; ?>
						</a>
							<?php }
						}
					?>
				</div>
				<div class="products-section">
					<div class="products-grid">
						<?php
							if (mysqli_num_rows($product_result) > 0) {
								while($row = mysqli_fetch_assoc($product_result)) {
									$details = $row['product_details'];
									include('inc/product_item.php');
								}
							}
						?>
					</div>
					<p class="product-no">Showing <b><?php echo max(0, min(1, mysqli_num_rows($product_result))) + $offset; ?> - <?php echo mysqli_num_rows($product_result) + $offset; ?></b> of <b><?php echo $total_products; ?></b> products</p>
					<div class="pagination">
						
						<a class="direction prev <?php if ($page <= 1): ?>hidden<?php endif; ?>" href="?<?php
							echo http_build_query(array(
								'page' => $page - 1,
								'id' => $categoryId
							)) ?>">PREV</a>
						

						<?php for ($i = 1; $i <= $total_pages; $i++): ?>
							<a class="number <?php if ($i === $page) echo 'active'; ?>" href="?<?php
							echo http_build_query(array(
								'page' => $i,
								'id' => $categoryId
							)) ?>">
								<?php echo $i; ?>
							</a>
						<?php endfor; ?>

						<a class="direction next <?php if ($page >= $total_pages): ?>hidden<?php endif; ?>" href="?<?php
							echo http_build_query(array(
								'page' => $page + 1,
								'id' => $categoryId
							)) ?>">NEXT</a>
					</div>
				</div>
			</div>
        </main>

		<!-- Filters menu for mobile -->
		<div id="filters-dropdown-menu" class="hidden">
			<div class="container">
				<div class="title">
					MENU
					<button class="material-symbols-outlined" data-dropdown-id="filters-dropdown-menu" onclick="ToggleDropdown(this)">close</button>
					<div class="divider"></div>
				</div>
				<div class="contents">
					<h1>Type</h1>
					<label><input type="checkbox"><span>Food</span></label>
					<label><input type="checkbox"><span>Musical Instruments</span></label>
					<label><input type="checkbox"><span>Kitchen Collection</span></label>
					<label><input type="checkbox"><span>Foliage</span></label>
					<label><input type="checkbox"><span>House Furniture</span></label>
					<label><input type="checkbox"><span>Outdoor Furniture</span></label>
					<label><input type="checkbox"><span>Miscellaneous</span></label>
					<div class="divider"></div>
					<h1>Size</h1>
					<label><input type="checkbox"><span>Tiny (Less than 3cm)</span></label>
					<label><input type="checkbox"><span>Small (3cm - 6cm)</span></label>
					<label><input type="checkbox"><span>Medium (7cm - 10cm)</span></label>
					<label><input type="checkbox"><span>Large (11cm - 15cm)</span></label>
					<label><input type="checkbox"><span>Massive (More than 15cm)</span></label>
					<div class="divider"></div>
					<h1>Price Range</h1>
					<label><input type="checkbox"><span>£0.49 or less</span></label>
					<label><input type="checkbox"><span>£0.50 - £0.99</span></label>
					<label><input type="checkbox"><span>£1.00 - £1.99</span></label>
					<label><input type="checkbox"><span>£2.00 - £2.99</span></label>
					<label><input type="checkbox"><span>£3.00 - £3.99</span></label>
					<label><input type="checkbox"><span>£4.00 - £4.99</span></label>
					<label><input type="checkbox"><span>£5.00 or more</span></label>
					<div class="divider"></div>
				</div>
			</div>
		</div>

		<!-- Footer -->
        <?php include("../website/inc/footer.php"); ?>

        <!-- JavaScript -->
        <script type="text/javascript" src="/smallmart/website/js/main.js"></script>
    </body>
</html>