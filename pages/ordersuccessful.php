<?php 
include "../controller/config.php"; 
session_start();
if(isset($_SESSION["email"])){  
}
else{
    header( "location: notlogin.html");
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful</title>
</head>
<body>

<?php //include"header.php" ?>
<?php include "sidebar.php"; ?>
<!-- <div class="content-inner"> -->
<div class="text-center mt-5 pt-5">
  <h1 class="display-3">Thank You!</h1>
  <p class="lead"><strong>The order has been placed successfully. It will be delivered Soon!!</p>
  <hr>
  <p class="lead">
    <a class="btn btn-success btn-sm" href="vieworders.php" role="button">View Orders</a>
  </p>
  <p>
    Having trouble? <a href="contactus.php">Contact us</a>
  </p>
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="main.php" role="button">Continue to homepage</a>
  </p>
</div>
</div>
</div>
</body>
</html>