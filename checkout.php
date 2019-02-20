<!DOCTYPE html>
<?php 
session_start();
include("functions/functions.php");
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Online shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./styles/style.css" media="all" />   
    <script src="main.js"></script>
</head>
<body>
    <!-- main content starts here -->
    <div class="main">
    
        <div class="header">
            <a href="index.php"><img id="banner" src="https://media.giphy.com/media/YJ13nuohgH6us/200.gif" /></a>
            <img id="logo" src="https://digitalsynopsis.com/wp-content/uploads/2015/12/creative-logo-animations-36.gif" />
        </div>

        <div class="menubar">
            <ul id="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="all_products.php">Products</a></li>
                <li><a href="customer/my_account.php">My Account</a></li>
                <li><a href="">Sign Up</a></li>
                <li><a href="cart.php">Shopping Cart</a></li>
                <li><a href="">Contact Us</a></li>
            </ul>

            <div id="form">
                <form method="get" action="results.php">
                    <input type="text" name="user_query" placeholder="Search a product" />
                    <input type="submit" name="search" value="Search" />
                </form>
            </div>
        </div>
        
        <div class="content">

            <div id="sidebar">

                <div id="sidebar-title">Categories</div>
                <ul id="cats">
                   <?php getCats() ?>
                </ul>

                <div id="sidebar-title">Brands</div>
                <ul id="cats">
                    <?php getBrands(); ?>
                    
                </ul>
                
            </div>


            <div id="content-area">
                <?php cart(); ?>
                <div id="shopping-cart">
                    <span style="float:right; font-size:18px;">
                        
                    <?php
                    if(!isset($_SESSION['email'])) {
                        echo "<b>Welcome:</b>" . $_SESSION['email'] . "<b style='color:yellow;'>Your</b>";
                    } else {
                        echo "<b>Welcome Guest</b>";
                    }
                    ?>
    
                    <b style="color:yellow">Shopping Cart</b> Total Items: <?php echo total(); ?> Total Price: <?php total_price(); ?><a href="cart.php" style="color:yellow;">Go to cart</a>
                    </span>
                </div>
            <div>

            <?php echo $ip=getIp(); ?>
            </div>
             
                 <?php 
                 if(!isset($_SESSION['email'])) {
                     include("customer_login.php");
                 } else {
                     include("payment.php");
                 }

                 ?>
                
             
            </div>

        </div>

        <div id="footer">
            <h2 style="text-align:center; padding-top:30px;">&copy; 2019</h2>
        </div>

    </div>

    <!-- main content ends here -->


</body>
</html>