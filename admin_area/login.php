<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/login_style.css">
    <script src="main.js"></script>
</head>
<body>

    <!-- Button to open the modal login form -->
    <button onclick="document.getElementById('id01').style.display='block'">Login</button>

    <!-- The Modal -->
    <div id="id01" class="modal">
    <h2><?php echo @$_GET['not_admin']; ?></h2>
    <span onclick="document.getElementById('id01').style.display='none'" 
    class="close" title="Close Modal">&times;</span>

    <!-- Modal Content -->
    <form class="modal-content animate" action="login.php">
        <div class="imgcontainer">
        <img src="img_avatar2.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <button type="submit">Login</button>
        <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>
    </div>
            
</body>
</html>

<?php 
session_start();
include("includes/db.php");
    if(isset($_POST['login'])) {
        $email = mysql_real_escape_string($_POST['email']);
        $name = mysql_real_escape_string($_POST['name']);

    $sel_user = "select * from admins where user_email='$email' and user_pass='$pass'";
    $run_user = mysqli_query($conncection, $sel_user);

    $check_user = mysqli_num_rows($run_user);
    if($check_user==0) {
        echo "<script>alert('Password or Email is wrong')</script>";
    } else {
        $_SESSION['user_email'] = $email;
        echo "<script>window.open('index.php?logged_in=You have successfully logged in','_self')</script>";
    }

    }

?>