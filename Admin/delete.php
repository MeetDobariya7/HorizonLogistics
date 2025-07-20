<?php
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
include_once '../include/config.php';
if(isset($_GET['uid'])){
$uid = $_GET['uid'];
$res = mysqli_query($conn, "DELETE FROM hl_register Where user_id=$uid");
header("manage_user.php");
exit;
}
if(isset($_GET['oid'])){
    $oid = $_GET['oid'];
    $res = mysqli_query($conn, "DELETE FROM hl_orders Where order_id=$oid");
    $cost_result =mysqli_query($conn,"DELETE FROM hl_payment Where order_id=$oid");
    $delivery_result = mysqli_query($conn, "DELETE FROM hl_delivery Where order_id=$oid");
    header("location: all_orders.php");
    exit;
    }
?>