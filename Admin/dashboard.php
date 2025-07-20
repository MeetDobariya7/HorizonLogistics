<?php require_once '../include/config.php';
session_start();
error_reporting(0);
if (!isset($_SESSION['adminid'])) {
  $msg = "<div class=\"alert alert-warning alert-dismissible fade in\" id=\"dangerb\">
  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
  <strong>WARNING!</strong> Login To Access...
</div>";
  $_SESSION['msg'] = $msg;
  header("location: admin_login.php");
}
$user = mysqli_query($conn, "SELECT * FROM hl_register");
if ($user && mysqli_num_rows($user) > 0) {
  $user_num = mysqli_num_rows($user);
}
$cost = mysqli_query($conn, "SELECT * FROM hl_payment");
if ($cost && mysqli_num_rows($cost) > 0) {
  $cost_num = mysqli_num_rows($cost);
}
$feedback = mysqli_query($conn, "SELECT * FROM hl_feedback where feedback!='no feedback'");
if ($feedback && mysqli_num_rows($feedback) > 0) {
  $feedback_num = mysqli_num_rows($feedback);
}
$order = mysqli_query($conn, "SELECT * FROM hl_orders");
if ($order && mysqli_num_rows($order) > 0) {
  $order_num = mysqli_num_rows($order);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../externalData/bootstrap-3.4.1-dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/dashboard.css" />
  <link rel="stylesheet" href="css/sidebar.css" />
  <script src="../externalData/jquery/jquery.min.js"></script>
  <script src="../externalData/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../externalData/fontawesome-free-6.4.2-web/css/all.min.css">
  <title>Dashboard</title>
</head>

<body>
  <?php require 'include/sidebar.php'; ?>
  <main class="content">
    <div class="dash">
      <div class="cards">
        <div class="card">
          <div class="box">
            <h1><?= $user_num ?></h1>
            <h3>Users</h3>
          </div>
          <div class="icon-case">
            <i class="fa-regular fa-user fa-4x" style="color: #058484;"></i>
          </div>
        </div>
        <div class="card">
          <div class="box">
            <h1><?= $order_num ?></h1>
            <h3>Orders</h3>
          </div>
          <div class="icon-case">
            <i class="fa-solid fa-truck-fast fa-4x" style="color: #058484;"></i>
          </div>
        </div>
        <div class="card">
          <div class="box">
            <h1><?= $cost_num ?></h1>
            <h3>Collection</h3>
          </div>
          <div class="icon-case">
            <i class="fa-solid fa-indian-rupee-sign fa-4x" style="color: #058484;"></i>
          </div>
        </div>
        <div class="card">
          <div class="box">
            <h1><?=$feedback_num?></h1>
            <h3>Feedbacks</h3>
          </div>
          <div class="icon-case">
            <i class="fa-regular fa-comments fa-4x" style="color: #058484;"></i>
          </div>
        </div>
      </div>
      <div class="content-2">
        <div class="recent-payments">
          <div class="title">
            <h2>Orders</h2>
            <a href="all_orders.php" class="btn">View All</a>
          </div>
          <div class="scroll-div">
            <table>
              <tbody>
                <tr>
                  <th>Order Name</th>
                  <th>Delivery Date</th>
                  <th>Shipping Method</th>
                  <th>Ammount</th>
                </tr>
                <?php $x = 1;
                while ($od = mysqli_fetch_array($order) and $cos = mysqli_fetch_array($cost)) {
                ?>
                  <tr>
                    <td><?= $od['orderName'] ?></td>
                    <td><?= $od['deliveryDate'] ?></td>
                    <td><?= $od['shippingMethod'] ?></td>
                    <td><?= $cos['cost'] ?></td>
                  </tr>
                <?php $x++;
                } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="new-students">
          <div class="title">
            <h2>Users</h2>
            <a href="manage_user.php" class="btn">View All</a>
          </div>
          <div class="scroll-div">
            <table>
              <tbody>
                <tr>
                  <th>User Id</th>
                  <th>Name</th>
                  <th>gender</th>
                </tr>
                <?php $x = 1;
                while ($row = mysqli_fetch_array($user)) {
                ?>
                  <tr>
                    <td><?= $x ?></td>
                    <td><?= $row['fullname'] ?></td>
                    <td><?= $row['gender'] ?></td>
                  </tr>
                <?php $x++;
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>