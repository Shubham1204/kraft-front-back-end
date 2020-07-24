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
    <title>Document</title>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/cef3123337.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php //include "header.php"; ?>
    <?php include "sidebar.php"; ?>
    <!-- <div class="content-inner"> -->
     
            <div class="container mt-5">    
                <div class="row">
                      <div class="panel panel-default">
                      <div class="panel-heading">  <h4 >User Profile</h4></div>
                       <div class="panel-body">
                      <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                       <img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive"> 
                     
                 
                      </div>
                     <?php $sql = "select username,email,contact from user_mst where user_mst.email='{$_SESSION['email']}'";
                            $result = mysqli_query($db,$sql) or die("Bad query $sql");
while($row = mysqli_fetch_assoc($result)){
?>
                      <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8 pt-5" >
                          <div class="container" >
                            <h1><?php echo "{$row['username']}" ?></h1>
                            <h4>an   <b> <?php echo "{$_SESSION['rolename']}" ?></b></h4>
                          
                           
                          </div>
                           <hr>
                          <ul class="container details" >
                            <li><h4><span class="glyphicon glyphicon-user one" style="width:50px;"></span><?php echo "{$row['username']}" ?></h2></li>
                            <li><h4><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span><?php echo "{$row['email']}" ?></h4></li>
                            <li><h4><span class="glyphicon glyphicon-phone one" style="width:50px;"></span><?php echo "{$row['contact']}" ?></h4></li>
                            <li><h4><span class="glyphicon glyphicon-pencil one" style="width:50px;"></span><a href="updateprofile.php">Edit</a></h4></li>
                          </ul>
                          
                      </div>
                </div>
            </div>
            </div>
            <?php
}
mysqli_close($db);
?>
            </div>
            </div>
</body>
</html>