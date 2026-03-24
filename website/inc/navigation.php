<?php
    // Cannot be directly accessed
    if (!defined('ALLOW_ACCESS')) {
        exit('No direct script access allowed');
    }
?>

<nav>
    <!-- Google Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL,GRAD@100..700,0..1,100&icon_names=account_circle,attach_money,blender,chevron_right,close,delete,favorite,filter_alt,fork_spoon,house,keyboard_arrow_down,keyboard_arrow_right,keyboard_arrow_up,menu,mode_comment,mood,music_note_2,nature,search,star,star_shine,stars,stars_2,sunny,visibility&display=block" />
    <!-- Logo -->
    <a href="/smallmart/website/" class="logo">
        <img src="/smallmart/website/assets/brand/full-logo.png">
    </a>
    <!-- Categories dropdown -->
    <a class="dropdown" data-dropdown-id="categories-dropdown" onclick="ToggleDropdown(this)">
        CATALOGUE
        <span class="material-symbols-outlined">keyboard_arrow_down</span>
    </a>
    <div id="categories-dropdown" class="hidden">
        <div class="categories key-categories">
            <a>
                <span class="material-symbols-outlined">star_shine</span>
                FEATURED
            </a>
            <a>
                <span class="material-symbols-outlined">stars</span>
                NEWLY ADDED
            </a>
            <a>
                <span class="material-symbols-outlined">attach_money</span>
                ON SALE
            </a>
            <a>
                <span class="material-symbols-outlined">mood</span>
                POPULAR
            </a>
        </div>
        <div class="categories">
            <a>
                <span class="material-symbols-outlined">fork_spoon</span>
                Food
            </a>
            <a>
                <span class="material-symbols-outlined">music_note_2</span>
                Musical Instruments
            </a>
            <a>
                <span class="material-symbols-outlined">blender</span>
                Kitchen Collection
            </a>
            <a>
                <span class="material-symbols-outlined">nature</span>
                Foliage
            </a>
            <a>
                <span class="material-symbols-outlined">house</span>
                House Furniture
            </a>
            <a>
                <span class="material-symbols-outlined">sunny</span>
                Outdoor Furniture
            </a>
            <a>
                <span class="material-symbols-outlined">stars_2</span>
                Miscellaneous
            </a>
        </div> 
    </div>
    <!-- More dropdown -->
    <a class="dropdown" data-dropdown-id="more-dropdown" onclick="ToggleDropdown(this, true)">
        MORE
        <span class="material-symbols-outlined">keyboard_arrow_down</span>
    </a>
    <div id="more-dropdown" class="hidden">
        <a>About Us</a>
        <a>Contact Us</a>
    </div>
    <!-- Search bar -->
    <div class="search-bar">
        <!-- <div class="container"> -->
            <form action="search.php" method="get" class="container" >
                <input type="text" name="q" placeholder="Search..." class="hide-validation-message"
                value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>" required>
                <button type="submit" class="material-symbols-outlined">search</button>
            </form>
        <!-- </div> -->
    </div>
    <!-- Wishlist -->
    <a href="/smallmart/website/" style="font-weight: normal" class="button">
        <span class="material-symbols-outlined">favorite</span>
        WISHLIST
    </a>
    <!-- Log in / account -->
    <a href="/smallmart/website/" class="button">
        <span class="material-symbols-outlined">account_circle</span>
        LOG IN
    </a>
</nav>