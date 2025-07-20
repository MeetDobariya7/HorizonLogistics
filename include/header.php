<?php
include 'include/config.php';
if (isset($_SESSION['uname'])) {
  $index_name = "<li><a href=\"profile.php\">Profile</a></li>";
} else {
  $index_name = null;
}
?>
<header>
  <div class="">
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Horizon Logistics</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Orders <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="new_order.php">New Order</a></li>
                <li><a href="previous_orders.php">Previous Orders</a></li>
                <li><a href="orderTrack.php">Order Tracking</a></li>
              </ul>
            </li>
            <?= $index_name ?>
            <li><a href="aboutUs.php">About Us</a></li>
            <li><a href="contactUs.php">Contact Us</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>
        </div>
      </div>
    </nav>
</header>