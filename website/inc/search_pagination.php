<?php
    // Search query
	$search = isset($_GET['q']) ? trim($_GET['q']) : '';

    // Only execute if there is a valid search query
    if ($search !== '') {
        $search_sql = mysqli_escape_string($dbconnect, $search);

        // Pagination setup
        $limit = 12;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max($page, 1); // ensure it's at least 1
        $offset = ($page - 1) * $limit;

        // Get total product count for page links
        $total_query = mysqli_query($dbconnect, 
            "SELECT COUNT(*)
            AS total
            FROM product
            WHERE product_name LIKE '%$search_sql%'
            OR product_description LIKE '%$search_sql%'"
        );
        $total_row = mysqli_fetch_assoc($total_query);
        $total_products = $total_row['total'];
        $total_pages = ceil($total_products / $limit);

        // Fetch products for this page
        $stmt =
            "SELECT *
            FROM product
            WHERE product_name LIKE '%?%'
            OR product_description LIKE '%?%'
            LIMIT ? OFFSET ?";
        $sql = $dbconnect->prepare($stmt);
        $sql->bind_param('ssii', $search_sql, $search_sql, $limit, $offset);
        $sql->execute();
        $product_result = $sql->get_result();
    }
?>