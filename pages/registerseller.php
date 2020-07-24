<?php 
include "../controller/config.php"; 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php //include"header.php" ?>
<?php include "sidebar.php"; ?>
<!-- <div class="content-inner"> -->
    <form action="../controller/registersellercontroller.php">
    <input type="text" placeholder="name" name="username">
    <input type="text" placeholder="email" name="email">
    <input type="password" placeholder="password" name="password">
    <input type="text" placeholder="contact" name="contact">
    <input type="text" placeholder="address line" name="address">
    <input type="text" placeholder="city" name="city">
    <input type="text" placeholder="state" name="state">
    <input type="text" placeholder="pincode" name="pincode">
    <input type="text" placeholder="pickup address" name="pickup">
    <button type="submit">Submit</button>
</form>
</div>
</div>
</body>
</html>