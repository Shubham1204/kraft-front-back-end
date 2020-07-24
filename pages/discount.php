<?php 
include "../controller/config.php"; 
session_start();
?>
<?php 
// session_start();
if(isset($_SESSION["email"])){  
}
else{
    header( "location: notlogin.html");
}if($_SESSION['rolename']=="seller"){
    
}
else{
    header("location: notseller.html");
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discount</title>
    <link href="../css/reg.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/cef3123337.js" crossorigin="anonymous"></script>
	
</head>
<body>
<?php //include "header.php"; ?>
<?php include "sidebar.php"; ?>
<!-- <div class="content-inner"> -->
      
      <!-- <div> -->
    
        <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
            <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Coupon will be applied on all your products</h2>
                </div>
                <div class="card-body">
                    <form action="../controller/discountcontroller.php" method="post">
                    <div class="form-row">
                        <div class="name">Discount Name</div>
                        <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="dname">
                                </div>
                            </div>
                        </div>
                    <div class="form-row">
                        <div class="name">Coupon Name</div>
                        <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="coupon">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Percentage %</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="percentage">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Max Amount</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="maxamount">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Last Date</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="date" name="lastdate">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn--radius-2 btn-danger" type="submit" name="submit">Add Coupon</button>
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
<!-- </div> -->
</body>
</html>