<!DOCTYPE html>
<?php 
session_start();
include("functions/functions.php");
include("includes/db.php");
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
                        Welcome Guest! <b style="color:yellow">Shopping Cart</b> Total Items: <?php echo total(); ?> Total Price: <?php total_price(); ?><a href="cart.php" style="color:yellow;">Go to cart</a>
                    </span>
                </div>
            <div>

            <?php echo $ip=getIp(); ?>
            </div>
             
                <form action="register.php" method="post" enctype="multipart/form-data">
                    <table align="center" width="750">
                        <tr>
                            <td><h2>Create an account</h2></td>
                        </tr>

                        <tr>
                            <td align="right">Name:</td>
                            <td><input type="text" name="c_name" required/></td>
                        </tr>

                        <tr>
                            <td align="right">Email:</td>
                            <td><input type="text" name="c_email" required/></td>
                        </tr>


                        <tr>
                            <td align="right">Password:</td>
                            <td><input type="password" name="c_pass" required/></td>
                        </tr>

                        <tr>
                            <td align="right">Image:</td>
                            <td><input type="file" name="c_image"></td>
                        </tr>

                        <tr>
                            <td align="right">Country:</td>
                            <td>
                                <select name="c_country" id="">
                                    <option value="">Select a country</option>
                                    <option value="">Japan</option>
                                    <option value="">India</option>
                                    <option value="">Europe</option>
                                    <option value="">UK</option>
                                    <option value="">US</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td align="right">City</td>
                            <td>
                                <input name="c_city" type="text"/>
                            </td>
                        </tr>

                        <tr>
                            <td align="right">Contact</td>
                            <td><input type="text" name="c_contact" /></td>
                        </tr>

                        <tr>
                            <td align="right">Address</td>
                            <td><textarea name="c_address" id="" cols="20" rows="10"></textarea></td>
                        </tr>

                        <tr align="center">
                           
                            <td><input type="submit" name="register" value="submit"></td>
                        </tr>

                    </table>
                </form>
             
            </div>

        </div>

        <div id="footer">
            <h2 style="text-align:center; padding-top:30px;">&copy; 2019</h2>
        </div>

    </div>

    <!-- main content ends here -->


</body>
</html>

<?php 
    if(isset($_POST['register'])) {
        $ip = getIp();
        $c_name = $_POST['c_name'];
        $c_email = $_POST['c_email'];
        $c_pass = $_POST['c_pass'];
        $c_image = $_FILES['c_image']['name'];
        $c_image_tmp = $_FILES['c_image']['tmp_name'];
        $c_country = $_POST['c_country'];
        $c_city = $_POST['c_city'];
        $c_contact = $_POST['c_contact'];
        $c_address = $_POST['c_address'];

        move_uploaded_file($c_image_tmp, "customer/customer_images/$c_image");

        $insert_c = "insert into customers (ip, name, email, pass, country, city, contact, address, image) values ('$ip', $c_name', '$c_email', '$c_pass', '$c_country', '$c_city', '$c_contact', '$c_address', '$c_image')";

        $run_c = mysqli_query($connection, $insert_c);

        $sel_cart = "select * from cart where ip_add='$ip'";

        $run_cart = mysqli_query($connection, $sel_cart);

        $check_cart = mysqli_num_rows($run_cart);

        if($check_cart == 0) {
            $_SESSION['email'] = $c_email;
            echo "<script>alert('Registration successful')</script>";
            echo "<script>window.open('customer/my_account.php', '_self')</script>";
        } else {
            $_SESSION['email'] = $c_email;
            echo "<script>alert('Registration successful')</script>";
            echo "<script>window.open('checkout.php', '_self')</script>";
        }
    }
?>