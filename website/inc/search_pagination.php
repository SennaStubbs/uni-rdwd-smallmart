<?php
    // Search query
	$search = isset($_GET['q']) ? trim($_GET['q']) : '';

    // Only execute if there is a valid search query
    if ($search !== '') {
        $search_sql = mysqli_escape_string($dbconnect, $search);

        // Pagination setup
        $limit = 9;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max($page, 1); // ensure it's at least 1
        $offset = ($page - 1) * $limit;

        // Get total product count for page links
        $total_query = mysqli_query($dbconnect, 
            "SELECT COUNT(*)
            AS total
            FROM product
            WHERE product_name LIKE '%$search%'
            OR product_description LIKE '%$search%'"
        );
        $total_row = mysqli_fetch_assoc($total_query);
        $total_products = $total_row['total'];
        $total_pages = ceil($total_products / $limit);

        // Fetch products for this page
        $sql =
            "SELECT *
            FROM product
            WHERE product_name LIKE '%$search%'
            OR product_description LIKE '%$search%'
            LIMIT $limit OFFSET $offset";
        $product_result = mysqli_query($dbconnect, $sql);
    }
?>