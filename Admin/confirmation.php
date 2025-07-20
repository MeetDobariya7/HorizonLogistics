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
 
    $delivery_result = mysqli_query($conn, "SELECT * FROM hl_delivery where deliveryStatus=1");
  if ($delivery_result && mysqli_num_rows($delivery_result) > 0) {
    $res = mysqli_query($conn, "SELECT * FROM hl_orders");
    $cost_result =mysqli_query($conn,"SELECT * FROM hl_payment");
  }
  if(isset($_GET['oid'])){
    $oid = $_GET['oid'];
    $delivery_result = mysqli_query($conn, "update hl_delivery set deliveryStatus='2' where id=$oid");
    $payment_result = mysqli_query($conn, "update hl_payment set confirmation='1' where id=$oid");
    header("location: confirmation.php");
  }
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../externalData/bootstrap-3.4.1-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/sidebar.css" />
    <link rel="stylesheet" href="css/table.css" />
    <script src="../externalData/jquery/jquery.min.js"></script>
    <script src="../externalData/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../externalData/fontawesome-free-6.4.2-web/css/all.min.css">
    <title>confirm order</title>
</head>

<body>
    <?php include_once 'include/sidebar.php'; ?>
    <div class="content">
        <div class="center">
            <main class="table">
                <section class="table__header">
                    <h1>Orders Requests</h1>
                </section>
                <section class="table__body">
                    <table>
                        <thead>
                            <tr>
                                <th> Id </th>
                                <th> Order Name </th>
                                <th> Delivery Date </th>
                                <th> Shipping Method </th>
                                <th> Status </th>
                                <th> Ammount </th>
                                <th> Operation </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $x=1;
                            while($row = mysqli_fetch_array($res) and $status = mysqli_fetch_array($delivery_result) and $cost = mysqli_fetch_array($cost_result)){
                                ?>
                                <tr>
                                <td><?=$x?></td>
                                <td><?=$row['orderName']?></td>
                                <td><?=$row['deliveryDate']?></td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$row['shippingMethod']?></td>
                                <td><?php if($status['deliveryStatus'] == 1){echo "<p class=\"status pending\">Pending</p>"; }
                                elseif($status['deliveryStatus'] == 2){echo "<p class=\"status process\">Processing</p>"; }
                                elseif($status['deliveryStatus'] == 3){echo "<p class=\"status shipped\">Shipped</p>"; }
                                elseif($status['deliveryStatus'] == 4){echo "<p class=\"status delivered\">Delivered</p>"; }
                                elseif($status['deliveryStatus'] == 0){echo "<p class=\"status cancelled\">Cancelled</p>"; }?></td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;<?=$cost['cost']?></td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="confirmation.php?oid=<?=$status['id'];?>" data-toggle="tooltip" title="Confirm"><i class="fa-solid fa-check fa-2x" style="color: #24d317;"></i></a></td>
                                </tr>   
                                <?php $x++; } ?>
                        </tbody>
                    </table>
                </section>
            </main>
        </div>
    </div>
    <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
</body>

</html>