<!DOCTYPE html>
<?php 
include("includes/db.php");
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
                <td colspan="8"><h2>Add New Product</h2></td>
            </tr>

            <tr>
                <td align="center">Product Title:</td>
                <td><input type="text" name="title" required/></td>
            </tr>

            <tr>
                <td align="center">Product Category:</td>
                <td>
                    <select name="category" id="" required>
                        <option disabled>Select a Category</option>
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
                        <option disabled>Select a Brand</option>
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
                <td><input type="file" name="image"/></td>
            </tr>
            <tr>
                <td align="center">Product Price:</td>
                <td><input type="text" name="price" required/></td>
            </tr>
            <tr>
                <td align="center">Product Description:</td>
                <td><textarea cols="20" rows="10" name="des" required></textarea></td>
            </tr>
            <tr>
                <td align="center">Product keywords:</td>
                <td><input type="text" name="keywords" required/></td>
            </tr>

            <tr align="center">
                <td colspan="8"><input type="submit" name="insert_product" value="Submit" /></td>
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

        $insert_product = "insert into products (brand,title,cat,price,des,keywords,image) values ('$brand','$title','$cat','$price','$description','$keywords','$img')";
    }
?>