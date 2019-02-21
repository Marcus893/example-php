                    
                <?php
                include("includes/db.php");
                    $user = $_SESSION['email'];
                    $get_customer = "select * from customers where email='$user'";
                    $run_customer = mysqli_query($connection, $get_customer);
                    $row_customer = mysqli_fetch_array($run_customer);
                    
                    $id = $row_customer['id'];
                    $name = $row_customer['name'];
                    $email = $row_customer['email'];
                    $pass = $row_customer['pass'];
                    $country = $row_customer['country'];
                    $city = $row_customer['city'];
                    $contact = $row_customer['contact'];
                    $address = $row_customer['address'];
                    $image = $row_customer['image'];
                ?>
                    

                <form action="" method="post" enctype="multipart/form-data">
                    <table align="center" width="750">
                        <tr>
                            <td><h2>Update account</h2></td>
                        </tr>

                        <tr>
                            <td align="right">Name:</td>
                            <td><input type="text" name="c_name" value="<?php echo $name; ?>" required/></td>
                        </tr>

                        <tr>
                            <td align="right">Email:</td>
                            <td><input type="text" name="c_email" value="<?php echo $email; ?>" required/></td>
                        </tr>


                        <tr>
                            <td align="right">Password:</td>
                            <td><input type="password" name="c_pass" value="<?php echo $pass; ?>" required/></td>
                        </tr>

                        <tr>
                            <td align="right">Image:</td>
                            <td><input type="file" name="c_image" /><img src="customer_images/<?php echo $image; ?>" /></td>
                        </tr>

                        <tr>
                            <td align="right">Country:</td>
                            <td>
                                <select name="c_country" disabled>
                                    <option value=""><?php echo $country; ?></option>
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
                                <input name="c_city" type="text" value="<?php echo $city; ?>"/>
                            </td>
                        </tr>

                        <tr>
                            <td align="right">Contact</td>
                            <td><input type="text" name="c_contact" value="<?php echo $contact; ?>" /></td>
                        </tr>

                        <tr>
                            <td align="right">Address</td>
                            <td><textarea name="c_address" id="" cols="20" rows="10"></textarea></td>
                        </tr>

                        <tr align="center">
                           
                            <td><input type="submit" name="update" value="Update" /></td>
                        </tr>

                    </table>
                </form>
             

<?php 
    if(isset($_POST['update'])) {
        $ip = getIp();

        $customer_id = $_GET['id'];
        $c_name = $_POST['c_name'];
        $c_email = $_POST['c_email'];
        $c_pass = $_POST['c_pass'];
        $c_image = $_FILES['c_image']['name'];
        $c_image_tmp = $_FILES['c_image']['tmp_name'];

        $c_city = $_POST['c_city'];
        $c_contact = $_POST['c_contact'];
        $c_address = $_POST['c_address'];

        move_uploaded_file($c_image_tmp, "customer_images/$c_image");

        $update_c = "update customers set name='$c_name', email='$c_email', pass='$c_pass', city='$c_city', contact='$c_contact', address='$c_address', image='$c_image' where id='$customer_id'";

        $run_update = mysqli_query($connection, $update_c);

        if($run_update) {
            echo "<script>alert('your account has been updated')</script>";
            echo "<script>window.open('my_account.php', '_self')</script>";
        }
    }
?>