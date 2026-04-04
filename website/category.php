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

	// Get category information
	if ($categoryId != -1) {
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

			$category_details = [];
			foreach (explode(',', $category_row['category_details']) as $detail) {
				$split_detail = preg_split("/=/", $detail, 2);
				if (isset($split_detail[0]) && isset($split_detail[1])) {
					$category_details[$split_detail[0]] = $split_detail[1];
				}
			}
		} else {
			header('location: error');
			exit;
		}
	}
	else {
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
								while($row = mysqli_fetch_assoc($product_result)) {
									$details = explode(',', $row['product_details']);
									include('inc/product.php');
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

		<!-- Footer -->
        <?php include("../website/inc/footer.php"); ?>

        <!-- JavaScript -->
        <script type="text/javascript" src="/smallmart/website/js/main.js"></script>
    </body>
</html>