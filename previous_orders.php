<?php require_once 'include/config.php';
session_start();
error_reporting(0);
if (!isset($_SESSION['id'])) {
    $msg = "<div class=\"alert alert-warning alert-dismissible fade in\" id=\"dangerb\">
    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
    <strong>WARNING!</strong> Login To Access...
  </div>";
    $_SESSION['msg'] = $msg;
    header("location: login.php");
}

$sid = $_SESSION['id'];

$res = mysqli_query($conn, "SELECT * FROM hl_orders where user_id=$sid");
$cost_result = mysqli_query($conn, "SELECT * FROM hl_payment where user_id=$sid");
$delivery_result = mysqli_query($conn, "SELECT * FROM hl_delivery where user_id=$sid");

if (isset($_GET['s'])) {
    $s = $_GET['s'];
    $f1 = "Average";
    $updatefeedback = mysqli_query($conn, "update hl_feedback set feedback='$f1' where id=$s");
    header("location: previous_orders.php");
} elseif (isset($_GET['d'])) {
    $d = $_GET['d'];
    $f2 = "Good";
    $updatefeedback = mysqli_query($conn, "update hl_feedback set feedback='$f2' where id=$d");
    header("location: previous_orders.php");
} elseif (isset($_GET['c'])) {
    $c = $_GET['c'];
    $f3 = "Excellent";
    $updatefeedback = mysqli_query($conn, "update hl_feedback set feedback='$f3' where id=$c");
    header("location: previous_orders.php");
}

if(isset($_GET['oid'])){
    $oid = $_GET['oid'];
    $res = mysqli_query($conn, "DELETE FROM hl_orders Where order_id=$oid");
    $cost_result =mysqli_query($conn,"DELETE FROM hl_payment Where order_id=$oid");
    $delivery_result = mysqli_query($conn, "DELETE FROM hl_delivery Where order_id=$oid");
    header("location: previous_orders.php");
    exit;
    }
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="externalData/bootstrap-3.4.1-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/table.css" />
    <script src="externalData/jquery/jquery.min.js"></script>
    <script src="externalData/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="externalData/fontawesome-free-6.4.2-web/css/all.min.css">
    <title>Previous Orders</title>
</head>

<body>
    <div class="content">
        <div class="center">
            <main class="table">
                <section class="table__header">
                    <h1>Previous Orders</h1>
                    <div class="btn">
                    <a href="index.php">Back</a>
                </div>
                </section>
                <section class="table__body">
                    <table>
                        <thead>
                            <tr>
                                <th> Id </th>
                                <th> Order Name </th>
                                <th> Delivery Date </th>
                                <th> Shipping Method </th>
                                <th> Ammount </th>
                                <th> Feedback </th>
                                <th> Operation </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x = 1;
                            while ($row = mysqli_fetch_array($res) and $status = mysqli_fetch_array($delivery_result) and $cost = mysqli_fetch_array($cost_result)) {
                            ?>
                                <tr>
                                    <td><?= $x ?></td>
                                    <td><?= $row['orderName'] ?></td>
                                    <td><?= $row['deliveryDate'] ?></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $row['shippingMethod'] ?></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;<?= $cost['cost'] ?></td>
                                    <td>
                                        <li><a href="previous_orders.php?s=<?= $row['order_id'] ?>">Average</a></li>
                                        <li><a href="previous_orders.php?d=<?= $row['order_id'] ?>">Good</a></li>
                                        <li><a href="previous_orders.php?c=<?= $row['order_id'] ?>">Excellent</a></li>
                                    </td>
                                    <td>&nbsp;&nbsp;&nbsp;<?php if($status['deliveryStatus'] != 4){ ?>
                                    <a href="edit_order.php?edit_id=<?=$row['order_id']?>" data-toggle="tooltip" title="Edit"><i class="fa-solid fa-edit" style="color:teal;"></i></a><?php }?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="previous_orders.php?oid=<?=$row['order_id'];?>" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-trash" style="color:red;"></i></a></td>
                                </tr>
                            <?php $x++;
                            } ?>
                        </tbody>
                    </table>
                </section>
            </main>
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    </div>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>

</html>