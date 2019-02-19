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

?>