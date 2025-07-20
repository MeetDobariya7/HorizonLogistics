<?php
session_start();
include 'include/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="externalData/bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="externalData/jquery/jquery.min.js"></script>
    <script src="externalData/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
    <title>Horizon Logistics</title>
    <style>
        .title {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .title h1 {
            color: #ffffff;
            font-size: 80px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
    </style>

</head>

<body>
    <div class="back1">
        <div class="title">
            <h1 class="">Horizon Logistics</h1>
        </div>
        <?php include 'include/header.php'; ?>
    </div>


</body>

</html>