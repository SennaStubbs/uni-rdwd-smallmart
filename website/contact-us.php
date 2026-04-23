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
        <title>Contact Us | Smallmart</title>
        <link rel="icon" type="image/png" href="/smallmart/website/assets/brand/small-logo.png">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="/smallmart/website/css/main.css">
        <link rel="stylesheet" type="text/css" href="/smallmart/website/css/information.css">
    </head>
    <body>
        <!-- Navigation bar -->
        <?php include("../website/inc/navigation.php"); ?>

        <!-- Header -->
        <header class="small" style="background-image: url(/smallmart/website/assets/misc/header.webp)">
			<div class="bg-colour" style="background-color: #F200FF"></div>
            <h1 class="title" style="background-color: #DC0293; box-shadow: 0px 5px 0px #BA0060; color: white">
				CONTACT US
			</h1>
        </header>

        <div class="grid-spacer"></div>

		<!-- Main contents -->
        <main class="center-page contact">
			<div class="content-container">
                <p>Looking to contact us for support or business inquiries? Email us at:</p>
                <h1>SENNASTUBBS@GMAIL.COM</h1>
                <p>You can also find us at: <strong>Salisbury SP4 7DE</strong></p>
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d25817.479784850202!2d-1.8505955!3d51.1824636!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4873e63b850af611%3A0x979170e2bcd3d2dd!2sStonehenge!5e1!3m2!1sen!2suk!4v1775311493538!5m2!1sen!2suk"
					width="922" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </main>

		<!-- Footer -->
        <?php include("../website/inc/footer.php"); ?>

        <!-- JavaScript -->
        <script type="text/javascript" src="/smallmart/website/js/main.js"></script>
    </body>
</html>