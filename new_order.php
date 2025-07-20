<?php
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
?>
<?php
include_once 'include/config.php';
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

    $km_price = 40 * $dist;
    $wht = $weight / 1000;
    if ($weight > 1000) {
        $base_price = $km_price * $wht;
    }
    else{
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

    $insert_query = mysqli_query($conn, "INSERT INTO hl_orders (user_id, orderName, productDiscription, productWeight, deliveryDistance, pickupAddress, pickupDate, deliveryAddress, deliveryDate, shippingMethod, itemState, otherInstructions) VALUES('$user_id', '$odr_name', '$p_d', '$weight', '$dist', '$p_addr', '$p_date', '$d_addr', '$d_date', '$s_method', '$i_state', '$other_i')");
    $select_result =mysqli_query($conn,"SELECT * FROM hl_orders where user_id='$user_id' and orderName='$odr_name' and productDiscription='$p_d' and productWeight='$weight' and deliveryDistance='$dist' and pickupAddress='$p_addr' and pickupDate='$p_date' and deliveryAddress='$d_addr' and deliveryDate='$d_date' and shippingMethod='$s_method' ");
    if ($select_result && mysqli_num_rows($select_result) > 0) {
        $row = mysqli_fetch_array($select_result);
        $k = $row['order_id'];
        $f = "no feedback";
        $feedback = mysqli_query($conn,"INSERT into hl_feedback(order_id,feedback) values('$k', '$f')");
        $cost_result =mysqli_query($conn,"INSERT into hl_payment(order_id, cost, confirmation, user_id) values('$k', '$base_price', 0,$user_id)");
        $delivery_result = mysqli_query($conn, "INSERT INTO hl_delivery(order_id, deliveryStatus, user_id) values('$k',1,$user_id)");
      }
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
    <title>New Order</title>
</head>

<body>
    <div class="form-box">
        <div class="main-user-info">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <h2 class="">Order Details</h2>
                <div class="form-group">
                    <label for="Oname">Order Name:</label>
                    <input type="text" class="form-control" id="Oname" name="Oname" placeholder="Enter Order Name" required>
                </div>
                <div class="form-group">
                    <label for="product_discription">Product Discription:</label>
                    <textarea class="form-control" id="product_discription" name="product_discription" rows="3" placeholder="Enter your message" required></textarea>
                </div>
                <div class="form-group">
                    <label for="weight">Product Weight:</label>
                    <input type="text" class="form-control" id="weight" name="weight" placeholder="Enter Product Weight" required>
                </div>
                <div class="form-group">
                    <label for="weight">Delivery Distance:</label>
                    <input type="text" class="form-control" id="distance" name="distance" placeholder="Enter Delivery Distance" required>
                </div>
                <div class="form-group">
                    <label for="p_address">Pickup Address:</label>
                    <textarea class="form-control" id="p_address" name="p_address" rows="2" placeholder="Enter Pickup Address" required></textarea>
                </div>
                <div class="form-group">
                    <label for="p_date">Pickup Date:</label>
                    <input type="date" class="form-control" id="p_date" name="p_date" placeholder="Enter Pickup Date" required>
                </div>
                <div class="form-group">
                    <label for="p_address">Delivery Address:</label>
                    <textarea class="form-control" id="d_address" name="d_address" rows="2" placeholder="Enter Delivery Address" required></textarea>
                </div>
                <div class="form-group">
                    <label for="d_date">Delivery Date:</label>
                    <input type="date" class="form-control" id="d_date" name="d_date" placeholder="Enter Delivery Date" required>
                </div>
                <div class="form-group">
                    <label for="shipping_method">Shipping Method:</label>
                    <select class="form-control" id="shipping_method" name="shipping_method" required>
                        <option value="economy">Economy</option>
                        <option value="standard">Standard</option>
                        <option value="express">Express</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="checkbox-inline">
                        <input type="checkbox" name="item_state[]" value="f">Fragile items
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="item_state[]" value="t">Temperature-Sensitive Goods
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="item_state[]" value="h">Hazardous Materials
                    </label>
                </div>
                <div class="form-group">
                    <label for="other_instructions">Other Instructions:</label>
                    <textarea class="form-control" id="other_instructions" name="other_instructions" rows="3" placeholder="Enter Other Instructions"></textarea>
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