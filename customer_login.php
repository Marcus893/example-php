<?php 
include("includes/db.php");
?>


<div>
    <form action="" method="post">
        <table>
            <tr><h2>Login In or Register</h2></tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="email" placeholder="enter email" required/></td>

            </tr>

            <tr>
                <td>Password:</td>
                <td><input type="password" name="pass" placeholder="enter password" required/></td>
            </tr>

            <tr>
                <td><a href="checkout.php?forget_pass">Forget your password?</a></td>
            </tr>

            <tr>
                <td><input type="submit" name="login" value="Login" /></td>
            </tr>
        </table>

            <h2 style="float:right;"><a href="register.php">New? Register Here!</a></h2>
    </form>

    <?php 
    if(isset($_POST['login'])) {
        $c_email = $_POST['email'];
        $c_pass = $_POST['pass'];

        $sel_c = "select * from customers where pass='$c_pass' and email='$c_email'";

        $run_c = mysqli_query($connection, $sel_c);

        $check_customer = mysqli_num_rows($run_c);

        if($check_customer==0) {
            echo "<script>alert('email or password is incorrect!')</script>";
            exit();
        }
        $ip = getIp();
        $sel_cart = "select * from cart where ip_add='$ip'";

        $run_cart = mysqli_query($connection, $sel_cart);

        $check_cart = mysqli_num_rows($run_cart);

        if($check_customer > 0 and $check_cart==0) {
            $_SESSION['email'] = $c_email;
            echo "<script>alert('Login successful')</script>";
            echo "<script>window.open('customer/my_account.php', '_self')</script>";
        } else {
            $_SESSION['email'] = $c_email;
            echo "<script>alert('Login successful')</script>";
            echo "<script>window.open('checkout.php', '_self')</script>";
        }
    }

    ?>
</div>