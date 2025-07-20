<?php include_once 'include/config.php';
session_start();
if(isset( $_SESSION['msg'])){
$msg = $_SESSION['msg'];
}
else{
    $msg = "";
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['username'];
    $pwd = $_POST['password'];
    $p_hash = md5($pwd);
    $res = mysqli_query($conn,"SELECT * FROM hl_register WHERE username='$uname' AND password='$p_hash'");
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['id']   = $row['user_id'];
        $_SESSION['uname'] = $row['username'];
        $_SESSION['password'] = $row['password'];
       header("location: index.php");
    } 
    else {
       $msg = "<div class=\"alert alert-danger alert-dismissible fade in\" id=\"dangerb\">
       <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
       <strong>ERROR!</strong> Wrong Username Or Password...
     </div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="externalData/bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="externalData/jquery/jquery.min.js"></script>
    <script src="externalData/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
    <title>login</title>
</head>

<body>

    <section>
        <div class="back1">
            <div class="form-box">
                <div class="form-value">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <h2>Login</h2>
                        <div class="inputbox">
                            <input type="text" id="username" name="username" required>
                            <label for="username">Username</label>
                        </div>
                        <div class="inputbox">
                            <input type="password" id="password" name="password" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="forget">
                            <a href="Admin/admin_login.php">Admin</a>
                        </div>
                        <div class="login-btn">
                            <input type="submit" value="Login">
                        </div>
                        <div class="register">
                            <p>Don't have a account <a href="register.php">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <?php include 'include/header.php'; ?>
        </div>
        <div class="foot">
      <?=$msg?>
      </div>
    </section>


</body>

</html>