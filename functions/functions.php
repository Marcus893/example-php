<?php
$connection = mysqli_connect("localhost", "root", "", "electronics");

function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

function cart() {
    if(isset($_GET['add_cart'])){
        global $connection;
        $ip = getIp();
        $pro_id = $_GET['add_cart'];
        $check_pro = "select * from cart where ip_add='$ip' and p_id='$pro_id'";

        $run_check = mysqli_query($connection, $check_pro);
        if(mysqli_num_rows($run_check) > 0) {
            echo "";
        } else {
            $insert_pro = "insert into cart (p_id,ip_add) values ('$pro_id','$ip')";
            $run_pro = mysqli_query($connection,$insert_pro);

            echo "<script>window.open('index.php', '_self')</script>";
        }
    }
}





// getting the categories 

function getCats() {

    global $connection;
    $get_cats = "select * from categories";
    $run_cats = mysqli_query($connection, $get_cats);

    while($row_cats=mysqli_fetch_array($run_cats)) {
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['title'];

    echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
    }
}

// getting the brands 

function getBrands() {

    global $connection;
    $get_brands = "select * from brands";
    $run_brands = mysqli_query($connection, $get_brands);

    while($row_brands=mysqli_fetch_array($run_brands)) {
        $brand_id = $row_brands['brand_id'];
        $brand_title = $row_brands['title'];

    echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
    }
}

function getPro() {

            global $connection;
            $get_pro = "select * from products order by rand() limit 6";
            $run_pro = mysqli_query($connection, $get_pro);

            while($row_pro=mysqli_fetch_array($run_pro)) {
                $pro_id = $row_pro['product_id'];
                $pro_brand = $row_pro['brand'];
                $pro_title = $row_pro['title'];
                $pro_cat = $row_pro['cat'];
                $pro_price = $row_pro['price'];
                $pro_des = $row_pro['des'];
                $pro_keywords = $row_pro['keywords'];
                $pro_image = $row_pro['image'];

                echo "
                    <div id='single-product'>
                        <h3>$pro_title</h3>
                        <img src='admin_area/product_images/$pro_image' width='180' height='180' />
                        <p><b>$ $pro_price</b></p>

                        <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                        <a href='index.php?add_cart=$pro_id'><button style='float:right'>Add To Cart</button></a>
                    </div>
                ";
            }

}

function getCatPro() {
    if(isset($_GET['cat'])) {
        
            $cat_id = $_GET['cat'];

            global $connection;
            $get_cat_pro = "select * from products where cat='$cat_id'";
            $run_cat_pro = mysqli_query($connection, $get_cat_pro);
            

            $count_cats = mysqli_num_rows($run_cat_pro);
            if($count_cats == 0) {
                echo "<h2>No Product in this category</h2>";
            } else {
                while($row_cat_pro=mysqli_fetch_array($run_cat_pro)) {
                    $pro_id = $row_cat_pro['product_id'];
                    $pro_brand = $row_cat_pro['brand'];
                    $pro_title = $row_cat_pro['title'];
                    $pro_cat = $row_cat_pro['cat'];
                    $pro_price = $row_cat_pro['price'];
                    $pro_image = $row_cat_pro['image'];
    
                   
                }
                echo "
                    <div id='single-product'>
                        <h3>$pro_title</h3>
                        <img src='admin_area/product_images/$pro_image' width='180' height='180' />
                        <p><b>$ $pro_price</b></p>

                        <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                        <a href='index.php?pro_id=$pro_id'><button style='float:right'>Add To Cart</button></a>
                    </div>
                ";

            }
        }
    

}

function getBrandPro() {
    if(isset($_GET['brand'])) {
        
            $brand_id = $_GET['brand'];

            global $connection;
            $get_brand_pro = "select * from products where brand='$brand_id'";
            $run_brand_pro = mysqli_query($connection, $get_brand_pro);
            

            $count_brands = mysqli_num_rows($run_brand_pro);
            if($count_brands == 0) {
                echo "<h2>No Product of this brand</h2>";
            } else {
                while($row_brand_pro=mysqli_fetch_array($run_brand_pro)) {
                    $pro_id = $row_brand_pro['product_id'];
                    $pro_brand = $row_brand_pro['brand'];
                    $pro_title = $row_brand_pro['title'];
                    $pro_cat = $row_brand_pro['cat'];
                    $pro_price = $row_brand_pro['price'];
                    $pro_image = $row_brand_pro['image'];
    
                   
                }
                echo "
                    <div id='single-product'>
                        <h3>$pro_title</h3>
                        <img src='admin_area/product_images/$pro_image' width='180' height='180' />
                        <p><b>$ $pro_price</b></p>

                        <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                        <a href='index.php?pro_id=$pro_id'><button style='float:right'>Add To Cart</button></a>
                    </div>
                ";

            }
        }
    

}

?>