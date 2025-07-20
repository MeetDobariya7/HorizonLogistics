<?php
session_start();
if (!isset($_SESSION['id'])) {
    $msg = "<div class=\"alert alert-warning alert-dismissible fade in\" id=\"dangerb\">
    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
    <strong>WARNING!</strong> Login To Access...
  </div>";
    $_SESSION['msg'] = $msg;
    header("location: login.php");
}
$msg = null;
?>
<?php
include_once 'include/config.php';
$s1 = $s2 = $s3 = $c1 = $c2 = $c3 = "";
if (isset($_GET['edit_id'])) {
    $eid = $_GET["edit_id"];
    $_SESSION['eid'] = $eid;
    $edit = mysqli_query($conn, "SELECT * from hl_orders where order_id=$eid");
    $row = mysqli_fetch_array($edit);
    if ($row['shippingMethod'] == "economy") {
        $s1 = "selected";
    } elseif ($row['shippingMethod'] == "standard") {
        $s2 = "selected";
    } elseif ($row['shippingMethod'] == "express") {
        $s3 = "selected";
    }

    if ($row['itemState'] == "1") {
        $c1 = "checked";
    } elseif ($row['itemState'] == "2") {
        $c1 = "checked";
        $c2 = "checked";
    } elseif ($row['itemState'] == "3") {
        $c1 = "checked";
        $c2 = "checked";
        $c3 = "checked";
    }
    if($edit == true){
        echo "true";
     }
     else{
        echo "false";
     }
} else {
    $row['orderName']=$row['productDiscription']=$row['productWeight']=$row['deliveryDistance']=$row['pickupAddress']=$row['pickupDate']=$row['deliveryAddress']=$row['deliveryDate']=$row['otherInstructions'] ="";
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $odr_name = $_POST['Oname'];
    $p_d = $_POST['product_discription'];
    $weight = $_POST['weight'];
    $dist = $_POST['distance'];
    $p_addr = $_POST['p_address'];
    $p_date = $_POST['p_date'];
    $d_addr = $_POST['d_address'];
    $d_date = $_POST['d_date'];
    $s_method = $_POST['shipping_method'];
    $item_state = $_POST['item_state'];
    $i_state = 0;
    for ($i = 0; $i < sizeof($item_state); $i++) {
        $i_state = $i_state + 1;
    }
    $other_i = $_POST['other_instructions'];
    $user_id = $_SESSION['id'];
    if(isset($_SESSION['eid'])) {
     $oid = $_SESSION['eid'];
    }
    $km_price = 40 * $dist;
    $wht = $weight / 1000;
    if ($weight > 1000) {
        $base_price = $km_price * $wht;
    } else {
        $base_price = $km_price;
    }

    if ($i_state == 1) {
        $a = $base_price * 0.2;
        $base_price = $base_price + $a;
    } elseif ($i_state == 2) {
        $a = $base_price * 0.4;
        $base_price = $base_price + $a;
    } elseif ($i_state == 3) {
        $a = $base_price * 0.6;
        $base_price = $base_price + $a;
    }

    $update_query = mysqli_query($conn,"UPDATE hl_orders set orderName='$odr_name', productDiscription='$p_d', productWeight='$weight', deliveryDistance='$dist', pickupAddress='$p_addr', pickupDate='$p_date', deliveryAddress='$d_addr', deliveryDate='$d_date', shippingMethod='$s_method', itemState='$i_state', otherInstructions='$other_i' where order_id='$oid' ");
    $cost_result = mysqli_query($conn,"UPDATE hl_payment set cost='$base_price', confirmation=0 where order_id='$oid' ");
    $delivery_result = mysqli_query($conn,"UPDATE hl_delivery set deliveryStatus=1 where order_id='$oid'");
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="externalData/bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/new_order.css">
    <script src="externalData/jquery/jquery.min.js"></script>
    <script src="externalData/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
    <title>Edit</title>
</head>

<body>
    <div class="form-box">
        <div class="main-user-info">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <h2 class="">Order Details</h2>
                <div class="form-group">
                    <label for="Oname">Order Name:</label>
                    <input type="text" class="form-control" id="Oname" value="<?= $row['orderName'] ?>" name="Oname" placeholder="Enter Order Name" required>
                </div>
                <div class="form-group">
                    <label for="product_discription">Product Discription:</label>
                    <textarea class="form-control" id="product_discription" name="product_discription" rows="3" placeholder="Enter your message" required><?= $row['productDiscription'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="weight">Product Weight:</label>
                    <input type="text" class="form-control" id="weight" value="<?= $row['productWeight'] ?>" name="weight" placeholder="Enter Product Weight" required>
                </div>
                <div class="form-group">
                    <label for="weight">Delivery Distance:</label>
                    <input type="text" class="form-control" id="distance" value="<?= $row['deliveryDistance'] ?>" name="distance" placeholder="Enter Delivery Distance" required>
                </div>
                <div class="form-group">
                    <label for="p_address">Pickup Address:</label>
                    <textarea class="form-control" id="p_address" name="p_address" rows="2" placeholder="Enter Pickup Address" required><?= $row['pickupAddress'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="p_date">Pickup Date:</label>
                    <input type="date" class="form-control" id="p_date" value="<?= $row['pickupDate'] ?>" name="p_date" placeholder="Enter Pickup Date" required>
                </div>
                <div class="form-group">
                    <label for="p_address">Delivery Address:</label>
                    <textarea class="form-control" id="d_address" name="d_address" rows="2" placeholder="Enter Delivery Address" required><?= $row['deliveryAddress'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="d_date">Delivery Date:</label>
                    <input type="date" class="form-control" id="d_date" value="<?= $row['deliveryDate'] ?>" name="d_date" placeholder="Enter Delivery Date" required>
                </div>
                <div class="form-group">
                    <label for="shipping_method">Shipping Method:</label>
                    <select class="form-control" id="shipping_method" name="shipping_method" required>
                        <option value="economy" <?= $s1 ?>>Economy</option>
                        <option value="standard" <?= $s2 ?>>Standard</option>
                        <option value="express" <?= $s3 ?>>Express</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="checkbox-inline">
                        <input type="checkbox" name="item_state[]" value="f" <?= $c1 ?>>Fragile items
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="item_state[]" value="t" <?= $c2 ?>>Temperature-Sensitive Goods
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="item_state[]" value="h" <?= $c3 ?>>Hazardous Materials
                    </label>
                </div>
                <div class="form-group">
                    <label for="other_instructions">Other Instructions:</label>
                    <textarea class="form-control" id="other_instructions" name="other_instructions" rows="3" placeholder="Enter Other Instructions"><?= $row['otherInstructions'] ?></textarea>
                </div>
                <input type="submit" value="Submit" class="btn btn-primary">
            </form>
        </div>
    </div>
    <div class="foot">
        <?= $msg ?>
    </div>
</body>

</html>