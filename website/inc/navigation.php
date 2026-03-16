<?php
    // Cannot be directly accessed
    if (!defined('ALLOW_ACCESS')) {
        exit('No direct script access allowed');
    }
?>

<nav>
    <!-- Logo -->
    <a href="/smallmart/website/" class="logo">
        <img src="/smallmart/website/assets/brand/full-logo.png">
    </a>
    <!-- Categories dropdown -->
    <a class="dropdown" onclick="ToggleDropdown(this, document.getElementById('categories-dropdown'))">
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
    <a class="dropdown" onclick="ToggleDropdown(this, document.getElementById('more-dropdown'), true)">
        MORE
        <span class="material-symbols-outlined">keyboard_arrow_down</span>
    </a>
    <div id="more-dropdown" class="hidden">
        <a>About Us</a>
        <a>Contact Us</a>
    </div>
    <!-- Search bar -->
    <div class="search-bar">
        <div class="container">
            <input type="text" placeholder="Search...">
            <button class="material-symbols-outlined">search</button>
        </div>
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