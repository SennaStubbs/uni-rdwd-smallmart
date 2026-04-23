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
        <title>About Us | Smallmart</title>
        <link rel="icon" type="image/png" href="/smallmart/website/assets/brand/small-logo.png">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="/smallmart/website/css/main.css">
        <link rel="stylesheet" type="text/css" href="/smallmart/website/css/information.css">
    </head>
    <body>
        <!-- Navigation bar -->
        <?php include("../website/inc/navigation.php"); ?>

        <!-- Header -->
        <header class="small" style="background-image: url(/smallmart/website/assets/header.webp)">
			<div class="bg-colour" style="background-color: #FF00A1"></div>
            <h1 class="title" style="background-color: #DC0247; box-shadow: 0px 5px 0px #BA0009; color: white">
				ABOUT US
			</h1>
        </header>

        <div class="grid-spacer"></div>

		<!-- Main contents -->
        <main class="center-page about">
			<div class="content-container">
                <p>
                    <strong>Smallmart</strong> is a store specializing in a diverse array of
                    handcrafted and readymade miniature collectibles. The
                    shop caters to collectors, hobbyists, and enthusiasts
                    seeking finely detailed miniatures that capture the
                    essence of their real-life counterparts.
                </p>
                <p><strong>Want to contact us?</strong></p>
                <a href="/smallmart/website/contact-us" class="animate-button-4px"><span>Click to visit!</span></a>
            </div>
        </main>

		<!-- Footer -->
        <?php include("../website/inc/footer.php"); ?>

        <!-- JavaScript -->
        <script type="text/javascript" src="/smallmart/website/js/main.js"></script>
    </body>
</html>