<!DOCTYPE html>
<?php 
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
            <img id="banner" src="https://media.giphy.com/media/YJ13nuohgH6us/200.gif" />
            <img id="logo" src="https://digitalsynopsis.com/wp-content/uploads/2015/12/creative-logo-animations-36.gif" />
        </div>

        <div class="menubar">
            <ul id="menu">
                <li><a href="">Home</a></li>
                <li><a href="">Products</a></li>
                <li><a href="">My Account</a></li>
                <li><a href="">Sign Up</a></li>
                <li><a href="">Shopping Cart</a></li>
                <li><a href="">Contact Us</a></li>
            </ul>

            <div id="form">
                <form method="get" action="results.php">
                    <input type="text" name="user_query" placeholder="Search a product" />
                    <input type="submit" name="search" value="search" />
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
                    <?php getBrands() ?>
                </ul>
                
            </div>


            <div id="content-area">
                <div id="shopping-cart">
                    <span style="float:right; font-size:18px;">
                        Welcome Guest! <b style="color:yellow">Shopping Cart</b> Total Items: Total Price:<a href="cart.php" style="color:yellow;">Go to cart</a>
                    </span>
                </div>
            <div>

            </div>
                    <?php 
                    if(isset($_GET['pro_id'])) {
                            $product_id = $_GET['pro_id'];
                            $get_pro = "select * from products where product_id='$product_id'";
                            $run_pro = mysqli_query($connection, $get_pro);
                        
                            while($row_pro=mysqli_fetch_array($run_pro)) {
                                $pro_id = $row_pro['product_id'];
                                $pro_title = $row_pro['title'];
                                $pro_price = $row_pro['price'];
                                $pro_des = $row_pro['des'];
                                $pro_image = $row_pro['image'];
                        
                                echo "
                                    <div id='single-product'>
                                        <h3>$pro_title</h3>
                                        <img src='admin_area/product_images/$pro_image' width='400' height='300' />
                                        <p><b>$ $pro_price</b></p>
                                        <p>$pro_des</p>
                                        <a href='index.php?' style='float:left;'>Go Back</a>
                                        <a href='index.php?pro_id=$pro_id'><button style='float:right'>Add To Cart</button></a>
                                    </div>
                                ";
                            }
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