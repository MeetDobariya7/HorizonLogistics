<?php include_once 'include/config.php';
session_start();
error_reporting(0);
if (!isset($_SESSION['id'])) {
    header("location: login.php");
} else {
    $uid = $_SESSION['id'];
}
$res = mysqli_query($conn, "SELECT * FROM hl_register where user_id=$uid");
if ($res && mysqli_num_rows($res) > 0) {
    $nums = mysqli_num_rows($res);
    $row = mysqli_fetch_array($res);
    $gen1 = "";
    $gen2 = "";
    $gen3 = "";
    if ($row['gender'] == "male") {
        $gen1 = "checked";
    } elseif ($row['gender'] == "female") {
        $gen2 = "checked";
    } elseif ($row['gender'] == "other") {
        $gen3 = "checked";
    }
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $num = $_POST['phoneNumber'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $gender = $_POST['gender'];
    if ($password == $confirmPassword) {
        $pass_hash = md5($password);
        $insert_query = mysqli_query($conn, "UPDATE hl_register set fullname='$fname', username='$uname', email='$email', phoneNumber='$num', password='$pass_hash', gender='$gender' where user_id='$uid' ");
        header("location: index.php");
        exit;
    } else {
        $msg = "<div class=\"alert alert-danger alert-dismissible fade in\" id=\"dangerb\">
        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
        <strong>ERROR!</strong> Password Are Not Matching...
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
    <script src="externalData/jquery/jquery.min.js"></script>
    <script src="externalData/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/profile.css">
    <title>Profile</title>
</head>

<body>
    <div class="center">
        <div class="bak">
            <div class="p_header">
                <h1>Profile</h1>
                <div class="btn">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
            <div class="p_body">
                <form class="" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-inline">
                        <h1> </h1>
                        <div class="form-box">
                            <div class="form-group">
                                <label for="fname" style="color: #056363;">FullName</label>
                                <input type="text" class="form-control" id="fname" value="<?= $row['fullname'] ?>" name="fname" required />
                            </div>
                            <div class="form-group">
                                <label for="uname" style="color: #056363;">Username</label>
                                <input type="text" class="form-control" id="uname" value="<?= $row['username'] ?>" name="uname" required />
                            </div>
                            <div class="form-group">
                                <label for="email" style="color: #056363;">Email</label>
                                <input type="email" class="form-control" id="email" value="<?= $row['email'] ?>" name="email" required>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="phoneNumber" style="color: #056363;">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNumber" value="<?= $row['phoneNumber'] ?>" name="phoneNumber" required />
                    </div>
                    <div class="form-group">
                        <label for="password" style="color: #056363;">Password</label>
                        <input type="password" class="form-control" id="password" value="" name="password" required />
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword" style="color: #056363;">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" value="" name="confirmPassword" required />
                    </div>
                    <div class="gender-details-box">
                        <span class="gender-title" style="color: #056363;"><label for="gender" style="color: #056363;">Gender</label></span>
                        <div class="gender-category">
                            <input type="radio" name="gender" id="male" value="male" <?= $gen1 ?>>
                            <label for="male">Male</label>
                            <input type="radio" name="gender" id="female" value="female" <?= $gen2 ?>>
                            <label for="female">Female</label>
                            <input type="radio" name="gender" id="other" value="other" <?= $gen3 ?>>
                            <label for="other">Other</label>
                        </div>
                    </div>
                    <div class="btn">
                        <input type="submit" value="Save Changes">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="foot">
        <?= $msg ?>
    </div>
</body>

</html>