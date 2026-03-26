<?php
    define('ALLOW_ACCESS', true);

    if (session_status() === PHP_SESSION_NONE) {
        session_start();

        include("../website/inc/dbconnect.php");

		
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
                    <div class="collection">
                        <div class="image" style="background-image: url(/smallmart/website/assets/header.webp)"></div>
                        <div class="title">
                            <h1>Food</h1>
                            <a>View Collection</a>
                        </div>
                    </div>
                    <div class="collection">
                        <div class="image" style="background-image: url(/smallmart/website/assets/header.webp)"></div>
                        <div class="title">
                            <h1>Food</h1>
                            <a>View Collection</a>
                        </div>
                    </div>
                    <div class="collection">
                        <div class="image" style="background-image: url(/smallmart/website/assets/header.webp)"></div>
                        <div class="title">
                            <h1>Foo asd sa sa  asd as asdasddad d</h1>
                            <a>View Collection</a>
                        </div>
                    </div>
                    <div class="collection">
                        <div class="image" style="background-image: url(/smallmart/website/assets/header.webp)"></div>
                        <div class="title">
                            <h1>Food</h1>
                            <a>View Collection</a>
                        </div>
                    </div>
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
						<div class="product">
							<div class="details">
								<div class="title">
									<!-- Product name -->
									<h1>Candle Set This is a long name</h1>
									<!-- Product price -->
									<h2>£1.19</h2>
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
								<div class="image" style="background-image: url(/smallmart/website/assets/header.webp)"></div>
							</div>
						</div>
						<?php for ($i = 0; $i < 9; $i++) {
							echo '<div class="product">
							<div class="details">
								<div class="title">
									<!-- Product name -->
									<h1>Candle Set</h1>
									<!-- Product price -->
									<h2>£1.19</h2>
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
								<div class="image" style="background-image: url(/smallmart/website/assets/header.webp)"></div>
							</div>
						</div>';
						} ?>
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
						<div class="product">
							<div class="details">
								<div class="title">
									<!-- Product name -->
									<h1>Candle Set This is a long name</h1>
									<!-- Product price -->
									<h2>£1.19</h2>
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
								<div class="image" style="background-image: url(/smallmart/website/assets/header.webp)"></div>
							</div>
						</div>
						<?php for ($i = 0; $i < 9; $i++) {
							echo '<div class="product">
							<div class="details">
								<div class="title">
									<!-- Product name -->
									<h1>Candle Set</h1>
									<!-- Product price -->
									<h2>£1.19</h2>
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
								<div class="image" style="background-image: url(/smallmart/website/assets/header.webp)"></div>
							</div>
						</div>';
						} ?>
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
						<div class="product">
							<div class="details">
								<div class="title">
									<!-- Product name -->
									<h1>Candle Set This is a long name</h1>
									<!-- Product price -->
									<h2>£1.19</h2>
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
								<div class="image" style="background-image: url(/smallmart/website/assets/header.webp)"></div>
							</div>
						</div>
						<?php for ($i = 0; $i < 9; $i++) {
							echo '<div class="product">
							<div class="details">
								<div class="title">
									<!-- Product name -->
									<h1>Candle Set</h1>
									<!-- Product price -->
									<h2>£1.19</h2>
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
								<div class="image" style="background-image: url(/smallmart/website/assets/header.webp)"></div>
							</div>
						</div>';
						} ?>
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