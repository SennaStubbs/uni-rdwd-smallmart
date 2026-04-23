<?php
    // Pagination setup
    $limit = 15;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max($page, 1); // ensure it's at least 1
    $offset = ($page - 1) * $limit;

    // Get total user's wishlist
    $stmt = "SELECT COUNT(*) as total FROM wishlist_product WHERE user_id = ?";
    $sql = $dbconnect->prepare($stmt);
    $sql->bind_param('i', $user_id);
    $sql->execute();
    $total_result = $sql->get_result();
    $total_row = mysqli_fetch_assoc($total_result);
    $total_products = $total_row['total'];
    $total_pages = ceil($total_products / $limit);

    // Fetch products for this page
    $stmt = "SELECT * FROM wishlist_product WHERE user_id = ? LIMIT ? OFFSET ?";
    $sql = $dbconnect->prepare($stmt);
    $sql->bind_param('iii', $user_id, $limit, $offset);
    $sql->execute();
    $wishlist_result = $sql->get_result();
?>