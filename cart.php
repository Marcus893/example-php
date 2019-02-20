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

                    
                    <b style="color:yellow">Shopping Cart</b> Total Items: <?php echo total(); ?> Total Price: <?php total_price(); ?><a href="cart.php" style="color:yellow;">Back</a>
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
                    <form method="post" enctype="multipart/form-data" action="">
                        <table align="center" width="700px" bgcolor="skyblue">
                            <tr align="center">
                                <td colspan="5"><h2>Update your cart or checkout</h2></td>
                            </tr>
                            <tr align="center">
                                <th>Remove</th>
                                <th>Products</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>

                            <?php  
                                $total = 0;
                                global $connection;
                            
                                $ip = getIp();
                                $sel_price = "select * from cart where ip_add='$ip'";
                                $run_price = mysqli_query($connection, $sel_price);
                                while($p_price=mysqli_fetch_array($run_price)) {
                                $pro_id = $p_price['p_id'];
                                $pro_price = "select * from products where product_id='$pro_id'";
                                $run_pro_price = mysqli_query($connection,$pro_price);
                            
                                while ($pp_price = mysqli_fetch_array($run_pro_price)) {
                                    $product_price = array($pp_price['price']);
                                    $product_title = $pp_price['title'];
                                    $product_img = $pp_price['image'];
                                    $single_price = $pp_price['price'];
                                    $values = array_sum($product_price);
                                    $total += $values;
                    
                            ?>
                            <tr align="center">
                                <td><input type="checkbox" name="remove" value="<?php echo $pro_id; ?>"/></td>
                                <td><?php echo $product_title; ?><br>
                                    <img src="admin_area/product_images/<?php echo $product_img; ?>" width="60" height="60" /></td>
                                <td><input type="text" size="4" name="qty" value="<?php echo $_SESSION['qty']; ?>"/></td>
                                <?php 
                                    if(isset($_POST['update_cart'])) {
                                        $qty = $_POST['qty'];
                                        $update_qty = "update cart set qty='$qty'";
                                        $run_qty = mysqli_query($connection, $update_qty);

                                        $_SESSION['qty']=$qty;
                                        $total = $total*$qty;
                                    }
                                ?>
                                <td><?php echo '$' . $single_price ?></td>
                            </tr>
                            <?php } } ?>

                            <tr align="right">
                                <td colspan="5"><b>Sub Total: </b></td>
                                <td colspan="5"><?php echo '$' . $total; ?></td>
                            </tr>

                            <tr align="center">
                                <td colspan="1"><input type="submit" name="update_cart" value="Update" /></td>
                                <td><input type="submit" name="continue" value="Continue Shopping" /></td>
                                <td><button><a href="checkout.php" style="text-decoration:none;">Checkout</a></button></td>
                            </tr>
                          
                        </table>
                    </form>
                    <?php 

                    function updatecart() {
                        global $connection;
                        $ip = getIp();

                        if(isset($_POST['update_cart'])) {
                            foreach($_POST['remove'] as $remove_id) {
                                $delete_product = "delete from cart where p_id='$remove_id' and ip_add='$ip'";
                                $run_delete = mysqli_query($connection, $delete_product);
                                
                                if($run_delete) {
                                    echo "<script>window.open('cart.php', '_self')</script>";
                                }
                            }
                        }
                        if(isset($_POST['continue'])) {
                            echo "<script>window.open('index.php', '_self')</script>";
                        }

                        echo @$up_cart = updatecart();
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