<?php
    // Getting category
    $categoryId = isset($_GET['id']) ? (int)$_GET['id'] : -1;
    if ($categoryId != -1) {
        $c1 = (string)$categoryId;
        $c2 = $categoryId . ',%';
        $c3 = '%,' . $categoryId;
        $c4 = '%,' . $categoryId . ',%';
    }

    // Pagination setup
    $limit = 9;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max($page, 1); // ensure it's at least 1
    $offset = ($page - 1) * $limit;

    // Get total product count for page links
    if ($categoryId != -1) {
        $total_stmt = "SELECT COUNT(*) AS total
                       FROM product
                       WHERE category_id LIKE ? OR
                               category_id LIKE ? OR
                               category_id LIKE ? OR
                               category_id LIKE ?";
        $total_sql = $dbconnect->prepare($total_stmt);
        $total_sql->bind_param('ssss', $c1, $c2, $c3, $c4);
    }
    else {
        $total_stmt = "SELECT COUNT(*) AS total
                       FROM product";
        $total_sql = $dbconnect->prepare($total_stmt);
    }
    $total_sql->execute();
    $total_result = $total_sql->get_result();
    $total_row = mysqli_fetch_assoc($total_result);
    $total_products = $total_row['total'];
    $total_pages = ceil($total_products / $limit);

    // Fetch products for this page
    if ($categoryId != -1) {
        $stmt = "SELECT *
                 FROM product
                 WHERE category_id LIKE ? OR
                       category_id LIKE ? OR
                       category_id LIKE ? OR
                       category_id LIKE ?
                 LIMIT $limit OFFSET $offset";
        $sql = $dbconnect->prepare($stmt);
        $sql->bind_param('ssss', $c1, $c2, $c3, $c4);
    }
    else {
        $stmt = "SELECT *
                 FROM product
                 LIMIT $limit OFFSET $offset";
        $sql = $dbconnect->prepare($stmt);
    }
    $sql->execute();
    $product_result = $sql->get_result();
?>