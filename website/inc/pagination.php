<?php
    // Getting category
    $category = isset($_GET['category']) ? (int)$_GET['category'] : -1;
    $c1 = (string)$category;
    $c2 = $category . ',%';
    $c3 = '%,' . $category;
    $c4 = '%,' . $category . ',%';

    // Pagination setup
    $limit = 9;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max($page, 1); // ensure it's at least 1
    $offset = ($page - 1) * $limit;

    // Get total product count for page links
    $total_stmt = "SELECT COUNT(*) AS total
                   FROM product
                   WHERE category_id LIKE ? OR
			 			 category_id LIKE ? OR
			 			 category_id LIKE ? OR
			 			 category_id LIKE ?";
    $total_sql = $dbconnect->prepare($total_stmt);
    $total_sql->bind_param('ssss', $c1, $c2, $c3, $c4);
    $total_sql->execute();
    $total_result = $total_sql->get_result();
    $total_row = mysqli_fetch_assoc($total_result);
    $total_products = $total_row['total'];
    $total_pages = ceil($total_products / $limit);

    // Fetch products for this page
    $stmt = "SELECT *
             FROM product
             WHERE category_id LIKE ? OR
                   category_id LIKE ? OR
                   category_id LIKE ? OR
                   category_id LIKE ?
             LIMIT $limit OFFSET $offset";
    $sql = $dbconnect->prepare($stmt);
    $sql->bind_param('ssss', $c1, $c2, $c3, $c4);
    $sql->execute();
    $product_result = $sql->get_result();
?>