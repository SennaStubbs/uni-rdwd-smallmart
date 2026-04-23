<?php
    // Getting category
    $categoryId = isset($_GET['id']) ? (int)$_GET['id'] : -1;
    if ($categoryId != -1) {
        $c1 = (string)$categoryId;
        $c2 = $categoryId . ',%';
        $c3 = '%,' . $categoryId;
        $c4 = '%,' . $categoryId . ',%';
    }
    else {
        header('location: error');
        exit;
    }

    // Pagination setup
    $limit = 12;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max($page, 1); // ensure it's at least 1
    $offset = ($page - 1) * $limit;

    // Get total product count
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
                LIMIT ? OFFSET ?";
    $sql = $dbconnect->prepare($stmt);
    $sql->bind_param('ssssii', $c1, $c2, $c3, $c4, $limit, $offset);
    $sql->execute();
    $product_result = $sql->get_result();
?>