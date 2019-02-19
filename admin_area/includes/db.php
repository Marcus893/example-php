<?php 

$connection = mysqli_connect("localhost", "root", "", "electronics");

if (mysqli_connect_error()) {
    echo "Failed to connect to MYSQL: " . mysqli_connect_error();
}
?>