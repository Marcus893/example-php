<!DOCTYPE html>
<?php 
include("includes/db.php");
if(isset($_GET['edit_pro'])) {
    $get_id = $_GET['edit_pro'];

    $get_pro = "select * from products where product_id='$get_id'";
    $run_pro = mysqli_query($connection, $get_pro);
 

    $row_pro=mysqli_fetch_array($run_pro);
        $pro_id = $row_pro['product_id'];
        $pro_title = $row_pro['title'];
        $pro_image = $row_pro['image'];
        $pro_price = $row_pro['price'];
        $pro_desc = $row_pro['des'];
        $pro_keywords = $row_pro['keywords'];
        $pro_category = $row_pro['cat'];
        $pro_brand = $row_pro['brand'];
       
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body bgcolor="skyblue">
    <form action="insert_product.php" method="post" enctype="multipart/form-data">
        <table align="center" width="1000px">
            <tr align="center">
                <td colspan="8"><h2>Edit This Product</h2></td>
            </tr>

            <tr>
                <td align="center">Product Title:</td>
                <td><input type="text" name="title" value="<?php echo $pro_title; ?>"/></td>
            </tr>

            <tr>
                <td align="center">Product Category:</td>
                <td>
                    <select name="category" id="" required>
                        <option disabled><?php echo $pro_category ?></option>
                        <?php 
                                $get_cats = "select * from categories";
                                $run_cats = mysqli_query($connection, $get_cats);
                            
                                while($row_cats=mysqli_fetch_array($run_cats)) {
                                    $cat_id = $row_cats['cat_id'];
                                    $cat_title = $row_cats['title'];
                            
                                echo "<option value='$cat_id'>$cat_title</option>";
                                }
                            
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="center">Product Brand:</td>
                <td>
                <select name="brand" id="">
                        <option disabled><?php echo $pro_brand; ?></option>
                        <?php 
                            $get_brands = "select * from brands";
                            $run_brands = mysqli_query($connection, $get_brands);

                            while($row_brands=mysqli_fetch_array($run_brands)) {
                                $brand_id = $row_brands['brand_id'];
                                $brand_title = $row_brands['title'];

                            echo "<option value='$brand_id'>$brand_title</option>";
                            }
                        
                            
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="center">Product Image:</td>
                <td><input type="file" name="image"/><img src="product_images/<?php echo $pro_image; ?>" width="60" height="60"/></td>
            </tr>
            <tr>
                <td align="center">Product Price:</td>
                <td><input type="text" name="price" value="<?php echo $pro_price; ?>"/></td>
            </tr>
            <tr>
                <td align="center">Product Description:</td>
                <td><textarea cols="20" rows="10" name="des" ><?php echo $pro_desc; ?></textarea></td>
            </tr>
            <tr>
                <td align="center">Product keywords:</td>
                <td><input type="text" name="keywords" value="<?php echo $pro_keywords; ?>"/></td>
            </tr>

            <tr align="center">
                <td colspan="8"><input type="submit" name="update_product" value="Update" /></td>
            </tr>
        </table>

    </form>
</body>
</html>

<?php 
    if(isset($_POST['insert_product'])) {
        $title = $_POST['title'];
        $cat = $_POST['category'];
        $brand = $_POST['brand'];
        $price = $_POST['price'];
        $description = $_POST['des'];
        $keywords = $_POST['keywords'];

        $img = $_FILES['image']['name'];
        $img_tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($img_tmp,"product_images/$img");

        $insert_product = "insert into products (brand,title,cat,price,des,keywords,image) values ('$brand','$title','$cat','$price','$description','$keywords','$img')";

        $insert = mysqli_query($connection, $insert_product);

        if($insert) {
            echo "<script>alert('Product has been inserted!')</script>";
            echo "<script>window.open('index.php?insert_product', '_self')</script>";
        }
    }
?>