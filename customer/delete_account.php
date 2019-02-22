<br>
<h2>Are you sure that you want to delete your account?</h2>
<form action="" method="post">

<br>
<input type="submit" name="yes" value="yes" />
<input type="submit" name="no" value="no" />

</form>

<?php 
include("includes/db.php");



$user = $_SESSION['email'];
if(isset($_POST['yes'])) {
    $delete_customer = "delete from customers where email='$user'";
    mysqli_query($connection, $delete_customer);

    echo "<script>alert('Your account has been deleted')</script>";
    echo "<script>window.open('../index.php','_self')</script>";
}

if(isset($_POST['no'])) {
    echo "<script>window.open('my_account.php', '_self')</script>";
}

?>