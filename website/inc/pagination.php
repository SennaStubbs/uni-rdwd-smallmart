<?php
    // Pagination setup
    $limit = 9;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max($page, 1); // ensure it's at least 1
    $offset = ($page - 1) * $limit;

    // Get total product count for page links
    $total_query = mysqli_query($dbconnect, "SELECT COUNT(*) AS total FROM product");
    $total_row = mysqli_fetch_assoc($total_query);
    $total_products = $total_row['total'];
    $total_pages = ceil($total_products / $limit);

    // Fetch products for this page
    $stmt = "SELECT * FROM product LIMIT $limit OFFSET $offset";
    $sql = $dbconnect->prepare($stmt);
    $sql->execute();
    $product_result = $sql->get_result();
?>