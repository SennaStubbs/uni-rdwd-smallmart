<?php
    define('ALLOW_ACCESS', true);

    if (session_status() === PHP_SESSION_NONE) {
        session_start();

        include("../website/inc/dbconnect.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home | Smallmart</title>
        <link rel="icon" type="image/png" href="/smallmart/website/assets/brand/small-logo.png">
        <!-- Google Material Symbols -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL,GRAD@100..700,0..1,100&icon_names=account_circle,attach_money,blender,chevron_right,close,delete,favorite,filter_alt,fork_spoon,house,keyboard_arrow_down,keyboard_arrow_up,menu,mode_comment,mood,music_note_2,nature,search,star,star_shine,stars,stars_2,sunny,visibility&display=block" />
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="/smallmart/website/css/main.css">
    </head>
    <body>
        <!-- Navigation bar -->
        <?php include("../website/inc/navigation.php"); ?>

        <!-- Header -->
        <header style="background-image: url(/smallmart/website/assets/header.webp)">
            <div class="content">
                <p>Large sale for various miniature products! Up to 50% off!!</p>
                <a>Check it out!</a>
            </div>
        </header>

        <main class="rows">
            <div class="row collections">
                <div class="container">
                    <div class="collection">
                        <div class="image" style="background-image: url(/smallmart/website/assets/header.webp)"></div>
                        <div class="title">
                            <h1>Food</h1>
                            <a>View Collection</a>
                        </div>
                    </div>
                    <div class="collection">
                        <div class="image" style="background-image: url(/smallmart/website/assets/header.webp)"></div>
                        <div class="title">
                            <h1>Food</h1>
                            <a>View Collection</a>
                        </div>
                    </div>
                    <div class="collection">
                        <div class="image" style="background-image: url(/smallmart/website/assets/header.webp)"></div>
                        <div class="title">
                            <h1>Food</h1>
                            <a>View Collection</a>
                        </div>
                    </div>
                    <div class="collection">
                        <div class="image" style="background-image: url(/smallmart/website/assets/header.webp)"></div>
                        <div class="title">
                            <h1>Food</h1>
                            <a>View Collection</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- JavaScript -->
        <script type="text/javascript" src="/smallmart/website/js/main.js"></script>
    </body>
</html>