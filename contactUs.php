<?php include_once 'include/config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $msg = $_POST['message'];
    $query = mysqli_query($conn,"INSERT INTO hl_contact (fullname, email, msg) values('$fname','$email','$msg')");
    if($query == true){
        header("location: index.php");
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
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Contact Us</title>
</head>

<body>
<section>
        <div class="back1">
            <div class="form-box">
                <div class="form-value">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <h2>Contact Us</h2>
                        <div class="inputbox">
                                <input type="text" id="fname" name="fname" required />
                                <label for="fname">FullName:</label>
                            </div>
                            <div class="inputbox">
                                <input type="email" id="email" name="email" required>
                                <label for="email">Email:</label>
                            </div>
                            <div class="form-group">
                            <label for="message" style="color: #fff;">Message:</label>
                                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Enter your message" required></textarea>
                            </div>
                        <div class="login-btn">
                            <input type="submit" value="Send">
                        </div>
                    </form>
                </div>
            </div>
            <?php include 'include/header.php'; ?>
        </div>
    </section>
</body>

</html>