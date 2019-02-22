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
            <a href="../index.php"><img id="banner" src="https://media.giphy.com/media/YJ13nuohgH6us/200.gif" /></a>
            <img id="logo" src="https://digitalsynopsis.com/wp-content/uploads/2015/12/creative-logo-animations-36.gif" />
        </div>

        <div class="menubar">
            <ul id="menu">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../all_products.php">Products</a></li>
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

                <div id="sidebar-title">My Account:</div>
                <ul id="cats">
                    <?php 
                    $user = $_SESSION['email'];
                    $get_img = "select * from customers where email='$user'";
                    $run_img = mysqli_query($connection, $get_img);
                    $row_img = mysqli_fetch_array($run_img);
                    $c_image = $row_img['image'];

                    $c_name = $row_img['name'];

                    echo "<img src='customer_images/$c_image' width='150' height='150' />";

                    ?>


                   <li><a href="my_account.php?my_orders">My Orders</a></li>
                   <li><a href="my_account.php?edit_account">Edit Account</a></li>
                   <li><a href="my_account.php?change_pass">Change Password</a></li>
                   <li><a href="my_account.php?delete_account">Delete Account</a></li>
                </ul>

        </div>


            <div id="content-area">
                <?php cart(); ?>
                <div id="shopping-cart">
                    <span style="float:right; font-size:18px; padding:5px; line-height:40px;">
                        
                    <?php
                    if(!isset($_SESSION['email'])) {
                        echo "<b>Welcome:</b>" . $_SESSION['email'];
                    } 
                    ?>
    
                        
                        

                    <?php 
                    if(!isset($_SESSION['email'])) {
                        echo "<a href='checkout.php'>Login</a>";
                    } else {
                        echo "<a href='logout.php'>Log Out</a>";
                    }
                    ?>
                    </span>
                </div>
            <div>

            <?php echo $ip=getIp(); ?>
            </div>
                <div id="product-box">
                    

                    <?php 
                    if(!isset($_GET['my_orders'])) {
                        if(!isset($_GET['edit_account'])) {
                            if(!isset($_GET['change_pass'])) {
                                if(!isset($_GET['delete_account'])) {
                                    
                            echo "
                            <h2>Welcome: <?php echo $c_name; ?></h2><br>;
                            <b>You can see your orders by clicking this <a href='my_account.php?my_orders'>link</a></b>";
                                }
                            }
                        }
                    }
                        ?>

                        <?php 
                        if(isset($_GET['edit_account'])) {
                            include("edit_account.php");
                        }

                        if(isset($_GET['change_pass'])) {
                            include("change_pass.php");
                        }

                        if(isset($_GET['delete_account'])) {
                            include("delete_account.php");
                        }
                        ?>
                </div>
            </div>

        </div>

        <div id="footer">
            <h2 style="text-align:center; padding-top:30px;">&copy; 2019</h2>
        </div>

    </div>

    <!-- main content ends here -->


</body>
</html>