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
 $res = mysqli_query($conn, "SELECT * FROM hl_register");
 if ($res && mysqli_num_rows($res) > 0) {
   $nums = mysqli_num_rows($res);
 }
?>
<!DOCTYPE html>
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
    <title>Users</title>
</head>

<body>
    <?php include_once 'include/sidebar.php'; ?>
    <div class="content">
        <div class="center">
            <main class="table">
                <section class="table__header">
                    <h1>All Users</h1>
                </section>
                <section class="table__body">
                    <table>
                        <thead>
                            <tr>
                                <th> Id </th>
                                <th> Fullname </th>
                                <th> Email </th>
                                <th> Phone Number </th>
                                <th> Gender </th>
                                <th> Option </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x=1;
                            while($row = mysqli_fetch_array($res)){
                                ?>
                                <tr>
                                <td><?=$x?></td>
                                <td><?=$row['fullname']?></td>
                                <td><?=$row['email']?></td>
                                <td><?=$row['phoneNumber']?></td>
                                <td><?=$row['gender']?></td>
                                <td><a href="delete.php?uid=<?=$row['user_id'];?>" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-trash" style="color:red;"></i></a></td>
                                </tr>
                         <?php $x++;} ?>
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