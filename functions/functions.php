<?php
$connection = mysqli_connect("localhost", "root", "", "electronics");

// getting the categories 

function getCats() {

    global $connection;
    $get_cats = "select * from categories";
    $run_cats = mysqli_query($connection, $get_cats);

    while($row_cats=mysqli_fetch_array($run_cats)) {
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['title'];

    echo "<li><a href='#'>$cat_title</a></li>";
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

    echo "<li><a href='#'>$brand_title</a></li>";
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
            <div id='single_product'>
                <h3>$pro_title</h3>
                <img src='admin_area/product_images/$pro_image' width='180' height='180' />
            </div>
        ";
    }
}
?>