<h2>Change Your Password</h2>

<form action="" method="post">
    <b>Enter the old password</b><input type="password" name="current_pass">
    <b>Enter New Password</b><input type="password" name="new_pass">
    <b>Enter New Password Again</b><input type="password" name="new_pass_again">

    <input type="submit" name="change_pass" value="Submit" />
</form>

<?php 

include("includes/db.php");

if(isset($_POST['change_pass'])) {
    $user = $_SESSION['email'];

    $current_pass = $_POST['current_pass'];
    $new_pass = $_POST['new_pass'];
    $new_again = $_POST['new_pass_again'];

    $sel_pass = "select * from customers where pass='$current_pass'";
    $run_pass = mysqli_query($connection, $sel_pass);
    $check_pass = mysqli_num_rows($run_pass);

    if($check_pass==0) {
        echo "<script>alert('Your entered the wrong password!')</script>";
        exit();
    }

    if($new_pass != $new_again) {
        echo "<script>alert('password do not match!')</script>";
        exit();
    } else {
        $update_pass = "update customers set pass='$new_pass' where email='$user'";
        $run_update = mysqli_query($connection, $update_pass);
        echo "<script>alert('Your password was updated successfully!')</script>";
        echo "<script>window.open('my_account.php', '_self')</script>";
    }
}

?>