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
    <title>Update Profile</title>
    <link href="../css/reg.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
<?php //include "header.php"; ?>
<?php include "sidebar.php"; ?>
<!-- <div class="content-inner"> -->
     
<div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Update Details</h2>
                </div>
                <div class="card-body">
                    <form action="../controller/updateprofilecontroller.php" method="post">
                    <?php
                     $sql = "select username,email,contact,password from user_mst where user_mst.email='{$_SESSION['email']}'";
                            $result = mysqli_query($db,$sql) or die("Bad query $sql");
while($row = mysqli_fetch_assoc($result)){
?>
                    <div class="form-row">
                            <div class="name">UserName</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="username" value="<?php echo "{$row['username']}" ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="email" value="<?php echo "{$row['email']}" ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Contact Number</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="contact" value="<?php echo "{$row['contact']}" ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="password" name="password" value="<?php echo "{$row['password']}" ?>">
                                </div>
                            </div>
                        </div>
<div>
                            <button class="btn btn--radius-2 btn-danger" type="submit" name="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/global.js"></script>   
</form>
</div>
</div>
<?php
 } 
 mysqli_close($db);
?>
</body>
</html>