<?php include 'include/config.php';
session_start();
error_reporting(0);
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
    $result = mysqli_query($conn, "SELECT * FROM hl_register WHERE username='$uname' AND password='$pass_hash'");
    if ($result && mysqli_num_rows($result) > 0) {
      $msg = "<div class=\"alert alert-danger alert-dismissible fade in\">
      <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
      <strong>ERROR!</strong> Username and Password are Already Taken.
    </div>";
    } else {
      $insert_query = mysqli_query($conn, "INSERT INTO hl_register (fullname, username, email, phoneNumber, password, gender) VALUES ('$fname', '$uname', '$email', '$num', '$pass_hash', '$gender')");
      $res = mysqli_query($conn, "SELECT * FROM hl_register WHERE username='$uname' AND password='$pass_hash'");
      if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['id']   = $row['user_id'];
        $_SESSION['uname'] = $row['username'];
        $_SESSION['password'] = $row['password'];
        header("location: index.php");
        exit;
      }
    }
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
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/register.css">
  <script src="externalData/jquery/jquery.min.js"></script>
  <script src="externalData/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
  <title>New User</title>
</head>

<body>
  <section>
    <div class="back1">
      <div class="form-box">
        <div class="main-user-info">
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h2 class="">Registration</h2>
            <div class="inputbox">
              <input type="text" id="fname" name="fname" required />
              <label for="fname">FullName</label>
            </div>
            <div class="inputbox">
              <input type="text" id="uname" name="uname" required />
              <label for="uname">Username</label>
            </div>
            <div class="inputbox">
              <input type="email" id="email" name="email" required>
              <label for="email">Email</label>
            </div>
            <div class="inputbox">
              <input type="text" id="phoneNumber" name="phoneNumber" required />
              <label for="phoneNumber">Phone Number</label>
            </div>
            <div class="inputbox">
              <input type="password" id="password" name="password" required />
              <label for="password">Password</label>
            </div>
            <div class="inputbox">
              <input type="password" id="confirmPassword" name="confirmPassword" required />
              <label for="confirmPassword">Confirm Password</label>
            </div>
            <div class="gender-details-box">
              <span class="gender-title">Gender</span>
              <div class="gender-category">
                <input type="radio" name="gender" id="male" value="male">
                <label for="male">Male</label>
                <input type="radio" name="gender" id="female" value="female">
                <label for="female">Female</label>
                <input type="radio" name="gender" id="other" value="other">
                <label for="other">Other</label>
              </div>
            </div>
            <div class="form-submit-btn">
              <input type="submit" value="Register">
            </div>
          </form>
        </div>
      </div>
      <?php include_once 'include/header.php'; ?>
    </div>
    <div class="foot">
      <?= $msg ?>
    </div>
  </section>

</body>