<?php 
session_start();
if(!isset($_SESSION['user_email'])) {
    echo "<script>window.open('login.php?not_admin=You are not an Admin', '_self')</script>";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/style.css">
    <script src="main.js"></script>
</head>
<body>
    <div class="main_wrapper">
        <h1 id="header">Manage Your Content</h1>

        <div id="right">
            <h2>Manage Content</h2>
            <a href="index.php?insert_product">Insert New Product</a>
            <a href="index.php?view_products">View Products</a>
            <a href="index.php?insert_cat">Insert New Category</a>
            <a href="index.php?view_cats">View All Categories</a>
            <a href="index.php?insert_brand">Insert New Brand</a>
            <a href="index.php?view_brands">View All Brands</a>
            <a href="index.php?view_customers">View Customers</a>
            <a href="index.php?view_orders">View Orders</a>
            <a href="index.php?view_payments">View Payments</a>
            <a href="logout.php">Admin Logout</a>
        </div>
        <div id="left">
            <?php 
                if(isset($_GET['insert_product'])) {
                    include("insert_product.php");
                }

                if(isset($_GET['view_products'])) {
                    include("view_products.php");
                }

                if(isset($_GET['edit_pro'])) {
                    include("edit_pro.php");
                }

                if(isset($_GET['insert_cat'])) {
                    include("insert_cat.php");
                }

                if(isset($_GET['view_cats'])) {
                    include("view_cats.php");
                }
            ?>
        </div>
    </div>
</body>
</html>