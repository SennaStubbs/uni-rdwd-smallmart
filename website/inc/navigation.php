<?php
    // Cannot be directly accessed
    if (!defined('ALLOW_ACCESS')) {
        exit('No direct script access allowed');
    }
?>

<nav>
    <a href="/smallmart/website/" class="logo">
        <img src="/smallmart/website/assets/brand/full-logo.png">
    </a>
    <a class="dropdown">
        CATALOGUE
        <span class="material-symbols-outlined">keyboard_arrow_down</span>
    </a>
    <a class="dropdown">
        MORE
        <span class="material-symbols-outlined">keyboard_arrow_down</span>
    </a>
    <div class="search-bar">
        <div class="container">
            <input type="text" placeholder="Search...">
            <button class="material-symbols-outlined">search</button>
        </div>
    </div>
    <a href="/smallmart/website/" style="font-weight: normal" class="button">
        <span class="material-symbols-outlined">favorite</span>
        WISHLIST
    </a>
    <a href="/smallmart/website/" class="button">
        <span class="material-symbols-outlined">account_circle</span>
        LOG IN
    </a>
</nav>