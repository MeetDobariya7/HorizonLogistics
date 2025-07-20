<?php include '../include/config.php';
session_start();
error_reporting(0);
if(isset( $_SESSION['msg'])){
    $msg = $_SESSION['msg'];
    }
    else{
        $msg = "";
    }?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['uname'];
    $pwd = $_POST['password'];
    $pass_hash = md5($pwd);
    $result = mysqli_query($conn,"SELECT * FROM hl_admin WHERE username='$uname' AND password='$pass_hash'");
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['adminid']   = $row['id'];
        $_SESSION['adminname'] = $row['username'];
        header("location: dashboard.php");
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
    <link rel="stylesheet" href="../externalData/bootstrap-3.4.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
    <script src="../externalData/jquery/jquery.min.js"></script>
    <script src="../externalData/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
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
                            <ion-icon name="person"></ion-icon>
                            <input type="text" id="uname" name="uname" required>
                            <label for="uname">Username</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="lock-closed"></ion-icon>
                            <input type="password" id="password" name="password" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="login-btn">
                            <input type="submit" value="Login">
                        </div>
                        <div class="register">
                            <p>Don't have a account <a href="../register.php">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
           <?php include_once 'include/header.php'; ?>
        </div>
        <div class="foot">
      <?=$msg?>
      </div>
    </section>
</body>

</html>