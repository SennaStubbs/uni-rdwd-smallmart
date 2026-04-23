<?php
    // Cannot be directly accessed
    if (!defined('ALLOW_ACCESS')) {
        exit('No direct script access allowed');
    }

    include('dbconnect.php');
?>

<nav>
    <!-- Google Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL,GRAD@100..700,0..1,100&icon_names=account_circle,attach_money,blender,chevron_right,close,delete,favorite,filter_alt,fork_spoon,house,keyboard_arrow_down,keyboard_arrow_right,keyboard_arrow_up,menu,mode_comment,mood,music_note_2,nature,search,star,star_shine,stars,stars_2,sunny,visibility,visibility_off&display=block" />
    <!-- Burger menu -->
    <a class="burger-button material-symbols-outlined animate-button-bg" data-dropdown-id="nav-burger-menu" onclick="ToggleDropdown(this)">
        menu
    </a>
    <div class="burger-menu hidden" id="nav-burger-menu">
        <div class="container">
            <div class="title">
                <h1>MENU</h1>
                <button class="material-symbols-outlined animate-button-bg" data-dropdown-id="nav-burger-menu" onclick="ToggleDropdown(this)">close</button>
            </div>
            <div class="burger-contents">
                <!-- Wishlist -->
                <a <?php if (isset($_SESSION['user_id'])) { echo 'href="/smallmart/website/wishlist"'; } else { echo 'href="/smallmart/website/log-in?redirect=wishlist"'; } ?>
                    class="animate-button-bg">
                    <span class="material-symbols-outlined">favorite</span>
                    <span>WISHLIST</span>
                </a>
                <div class="divider"></div>
                <!-- Categories dropdown -->
                <a class="dropdown animate-button-bg" data-dropdown-id="mobile-categories-dropdown" onclick="ToggleDropdown(this)">
                    <span>CATALOGUE</span>
                    <span class="material-symbols-outlined">keyboard_arrow_down</span>
                </a>
                <div class="divider"></div>
                <div id="mobile-categories-dropdown" class="dropdown-menu hidden">
                    <div class="categories key-categories">
                        <?php
                            // Get categories that have 'main_category=true' in their details
                            $stmt = "SELECT *
                                    FROM category
                                    WHERE SUBSTRING_INDEX(
                                            SUBSTRING_INDEX(category_details, 'main_category=', -1),
                                            ',', 1) = 'true'";
                            $sql = $dbconnect->prepare($stmt);
                            $sql->execute();
                            $main_cate_results = $sql->get_result();

                            if (mysqli_num_rows($main_cate_results) > 0) {
                                while($row = mysqli_fetch_assoc($main_cate_results)) {
                                    foreach (explode(',', $row['category_details']) as $detail) {
                                        $split_detail = preg_split("/=/", $detail, 2);
                                        if (trim($split_detail[0]) == 'icon') { ?>
                        <a href="/smallmart/website/category?id=<?php echo $row['category_id'] ?>" class="animate-button-bg-round">
                            <span class="material-symbols-outlined"><?php echo $split_detail[1] ?></span>
                            <?php echo strtoupper($row['category_name']); ?>
                        </a>
                                        <?php }
                                    }
                                }
                            }
                        ?>
                    </div>
                    <div class="divider"></div>
                    <div class="categories">
                        <?php
                            // Get categories that do not have 'main_category=true' in their details
                            $stmt = "SELECT *
                                    FROM category
                                    WHERE SUBSTRING_INDEX(
                                            SUBSTRING_INDEX(category_details, 'main_category=', -1),
                                            ',', 1) != 'true'";
                            $sql = $dbconnect->prepare($stmt);
                            $sql->execute();
                            $category_result = $sql->get_result();
                            
                            if (mysqli_num_rows($category_result) > 0) {
                                while($row = mysqli_fetch_assoc($category_result)) {
                                    foreach (explode(',', $row['category_details']) as $detail) {
                                        $split_detail = preg_split("/=/", $detail, 2);
                                        if (trim($split_detail[0]) == 'icon') { ?>
                        <a href="/smallmart/website/category?id=<?php echo $row['category_id'] ?>" class="animate-button-bg-round">
                            <span class="material-symbols-outlined"><?php echo $split_detail[1] ?></span>
                            <?php echo $row['category_name']; ?>
                        </a>
                                        <?php }
                                    }
                                }
                            }
                        ?>
                    </div> 
                </div>
                <div class="divider"></div>
                <!-- More dropdown -->
                <a class="dropdown animate-button-bg" data-dropdown-id="mobile-more-dropdown" onclick="ToggleDropdown(this, true)">
                    <span>MORE</span>
                    <span class="material-symbols-outlined">keyboard_arrow_down</span>
                </a>
                <div class="divider"></div>
                <div id="mobile-more-dropdown" class="dropdown-menu hidden">
                    <a href="/smallmart/website/about-us" class="animate-button-bg-round">ABOUT US</a>
                    <a href="/smallmart/website/contact-us" class="animate-button-bg-round">CONTACT US</a>
                </div>
                <div class="divider"></div>
            </div>
        </div>
    </div>
    <!-- Logo -->
    <a href="/smallmart/website/" class="logo animate-button-bg">
        <!-- <img src="/smallmart/website/assets/brand/full-logo.png"> -->
    </a>
    <!-- Categories dropdown -->
    <a class="dropdown animate-button-bg" data-dropdown-id="categories-dropdown" onclick="ToggleDropdown(this)">
        CATALOGUE
        <span class="material-symbols-outlined">keyboard_arrow_down</span>
    </a>
    <div id="categories-dropdown" class="hidden">
        <div class="categories key-categories">
            <?php
                // Get categories that have 'main_category=true' in their details
                $stmt = "SELECT *
                        FROM category
                        WHERE SUBSTRING_INDEX(
                                SUBSTRING_INDEX(category_details, 'main_category=', -1),
                                ',', 1) = 'true'";
                $sql = $dbconnect->prepare($stmt);
                $sql->execute();
                $main_cate_results = $sql->get_result();

                if (mysqli_num_rows($main_cate_results) > 0) {
                    while($row = mysqli_fetch_assoc($main_cate_results)) {
                        foreach (explode(',', $row['category_details']) as $detail) {
			                $split_detail = preg_split("/=/", $detail, 2);
                            if (trim($split_detail[0]) == 'icon') { ?>
            <a href="/smallmart/website/category?id=<?php echo $row['category_id'] ?>" class="animate-button-bg-round">
                <span class="material-symbols-outlined"><?php echo $split_detail[1] ?></span>
                <?php echo strtoupper($row['category_name']); ?>
            </a>
                            <?php }
                        }
                    }
                }
            ?>
        </div>
        <div class="categories">
            <?php
                // Get categories that do not have 'main_category=true' in their details
                $stmt = "SELECT *
                        FROM category
                        WHERE SUBSTRING_INDEX(
                                SUBSTRING_INDEX(category_details, 'main_category=', -1),
                                ',', 1) != 'true'";
                $sql = $dbconnect->prepare($stmt);
                $sql->execute();
                $category_result = $sql->get_result();
                
                if (mysqli_num_rows($category_result) > 0) {
                    while($row = mysqli_fetch_assoc($category_result)) {
                        foreach (explode(',', $row['category_details']) as $detail) {
			                $split_detail = preg_split("/=/", $detail, 2);
                            if (trim($split_detail[0]) == 'icon') { ?>
            <a href="/smallmart/website/category?id=<?php echo $row['category_id'] ?>" class="animate-button-bg-round">
                <span class="material-symbols-outlined"><?php echo $split_detail[1] ?></span>
                <?php echo $row['category_name']; ?>
            </a>
                            <?php }
                        }
                    }
                }
            ?>
        </div> 
    </div>
    <!-- More dropdown -->
    <a class="dropdown animate-button-bg" data-dropdown-id="more-dropdown" onclick="ToggleDropdown(this, true)">
        MORE
        <span class="material-symbols-outlined">keyboard_arrow_down</span>
    </a>
    <div id="more-dropdown" class="hidden">
        <a href="/smallmart/website/about-us" class="animate-button-bg-round">About Us</a>
        <a href="/smallmart/website/contact-us" class="animate-button-bg-round">Contact Us</a>
    </div>
    <!-- Search bar -->
    <div class="search-bar">
        <!-- <div class="container"> -->
            <form action="search.php" method="get" class="container" >
                <input type="text" name="q" placeholder="Search..." class="hide-validation-message"
                value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>" required>
                <button type="submit" class="material-symbols-outlined animate-button-bg">search</button>
            </form>
        <!-- </div> -->
    </div>
    <!-- Wishlist -->
    <a <?php if (isset($_SESSION['user_id'])) { echo 'href="/smallmart/website/wishlist"'; } else { echo 'href="/smallmart/website/log-in?redirect=wishlist"'; } ?>
        style="font-weight: normal" class="button wishlist animate-button-bg">
        <span class="material-symbols-outlined">favorite</span>
        <span>WISHLIST</span>
    </a>
    <!-- Log in / account -->
    <?php
        // Get user information
        $userId = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : -1;

        $stmt = "SELECT user_display_name FROM user WHERE user_id = ?";
        $sql = $dbconnect->prepare($stmt);
        $sql->bind_param('i', $userId);
        $sql->execute();
        $user_result = $sql->get_result();

        if (isset($_SESSION['user_id']) && mysqli_num_rows($user_result) > 0) {
            $row = mysqli_fetch_assoc($user_result);
    ?>
    <a href="/smallmart/website/user" class="button account animate-button-bg" title="Logged in as: <?php echo $row['user_display_name'] ?>">
        <span class="material-symbols-outlined filled">account_circle</span>
        <span>ACCOUNT</span>
    </a>
    <?php } else { ?>
    <a href="/smallmart/website/log-in" class="button account animate-button-bg">
        <span class="material-symbols-outlined">account_circle</span>
        <span>LOG IN</span>
    </a>
    <?php } ?>
</nav>