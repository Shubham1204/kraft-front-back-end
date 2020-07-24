<?php 
include "../controller/config.php"; 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		
</head>
<body style="background-color: #EEF5F9">
<?php //include "header.php"; ?>
<?php include "sidebar.php"; ?>
<!-- <div class="content-inner"> -->
   <?php $sql = "SELECT orderid,orderstatus, custid, orderdate, pid, expecteddate, amount, shippingcost, paymentmethod, time FROM order_mst WHERE order_mst.custid=(select uid from user_mst where email='{$_SESSION['email']}') ORDER BY orderdate ASC, time DESC";
$result = mysqli_query($db,$sql) or die("Bad query $sql");
while($row = mysqli_fetch_assoc($result)){
    $productid=$row['pid'];
    $sql1 = "SELECT  pname, pcost, expecteddeliverdate,discount, shippingcost, ptype, returnpolicy FROM `product_mst` WHERE pid=$productid";
    $result1 = mysqli_query($db,$sql1) or die("Bad query $sql1");
while($row1 = mysqli_fetch_assoc($result1)){
    $sql2="select imagepath from product_image_mst where productid={$row['pid']} LIMIT 1";
    $result2 = mysqli_query($db,$sql2) or die("Bad query $sql2");
     ?>
<div class="container-fluid my-5 d-sm-flex justify-content-center">
    <div class="card">
        <div class="card-header bg-white">
            <div class="row justify-content-between">
                <div class="col">
                    <p class="text-muted"> Order ID <span class="font-weight-bold text-dark"><?php echo"{$row['orderid']}" ?></span></p>
                    <p class="text-muted"> Placed On <span class="font-weight-bold text-dark"><?php echo"{$row['orderdate']}" ?> at <?php echo"{$row['time']}" ?></span> </p>
                </div>
                <!-- <div class="flex-col my-auto">
                    <h6 class="ml-auto mr-3"> <a href="#">View Details</a> </h6>
                </div> -->
            </div>
        </div>
        <div class="card-body">
            <div class="media flex-column flex-sm-row">
                <div class="media-body ">
                    <h5><?php echo"{$row1['pname']}" ?></h5>
                    <p class="text-muted"> Qt: 1(ONE)</p>
                    <h4 class="mt-3"> <span class="mt-5">&#x20B9;</span> <?php echo"{$row['amount']}" ?> <span class="small text-muted"> via (COD) </span></h4>

                    <p class="text-muted">Expected Delivery: <span><?php date_default_timezone_set("Asia/Calcutta"); $days = $row1['expecteddeliverdate']; $d=strtotime("+$days Days"); echo date("d-m-Y", $d);?></span></p> 
                    <?php 
                        $ostatus="{$row['orderstatus']}"; 
                        if($ostatus=="processed"){ ?>
                            <button type="button" class="btn btn-outline-primary d-flex">Order Processing!</button>
                        <?php }else if($ostatus=="shipped"){ ?>
                            <button type="button" class="btn btn-outline-primary d-flex">Order Shipped!</button>
                        <?php }else if($ostatus=="enrute"){ ?>
                            <button type="button" class="btn btn-outline-primary d-flex">Order En Rute!</button>
                        <?php  }else if($ostatus=="delivered"){ ?>
                            <button type="button" class="btn btn-outline-success d-flex">Order Delieverd!</button>
                        <?php  }else if($ostatus=="cancel"){ ?>
                            <button type="button" class="btn btn-outline-danger d-flex">Order Cancelled!</button>
                        <?php }
                    ?>
                    
                    

<!-- <div id="<?php //echo"{$row1['pname']}detail" ?>" class="collapse mt-2">
<p class="text-muted">Product type: <span><?php //echo"{$row1['ptype']}" ?></span></p> 
<p class="text-muted">Price: <span class="text-right"><?php //echo"{$row1['pcost']}" ?></span></p>
<p class="text-muted">Discount: <span class="text-right"><?php //echo"{$row1['discount']}" ?>%</span></p>
<p class="text-muted">Shipping Cost: <span class="text-right"><?php //echo"{$row1['shippingcost']}" ?></span></p>
<p class="text-muted">Total Amount: <span class="text-right"><?php //echo"{$row['amount']}" ?></span></p>
</div> -->
<?php while($row2 = mysqli_fetch_assoc($result2)){ ?>
                </div><img class="ml-4 align-self-center img-fluid" src="<?php echo"{$row2['imagepath']}" ?>" width="180 " height="180">
                <?php } ?>
            </div>
        </div>
        <!-- <div class="row px-3">
            <div class="col">
                <ul id="progressbar">
                    <li class="step0 active " id="step1">PLACED</li>
                    <li class="step0 active text-center" id="step2">SHIPPED</li>
                    <li class="step0 text-muted text-right" id="step3">DELIVERED</li>
                </ul>
            </div>
        </div> -->
        <div class="card-footer bg-white px-sm-3 pt-sm-4 px-0">
            <div class="row text-center ">
            <div class="col my-auto border-line">
                   <a href="vieworderdetails.php?oid=<?php echo"{$row['orderid']}" ?>&pid=<?php echo"{$productid}" ?>&odate=<?php echo"{$row['orderdate']}" ?>"><h5 class="btn btn-primary">View Details</h5></a>
                </div>
                <!-- <div class="col my-auto border-line ">
                    <h5  class="btn btn-primary">Track</h5>
                </div>
                <div class="col my-auto border-line ">
                    <h5 class="btn btn-primary">Cancel</h5>
                </div> -->
                <!-- <div class="col my-auto border-line ">
                    <h5>Pre-pay</h5>
                </div> -->
                <!-- <div class="col my-auto mx-0 px-0 "><img class="img-fluid cursor-pointer" src="https://img.icons8.com/ios/50/000000/menu-2.png" width="30" height="30"></div> -->
            </div>
        </div>
    </div>
</div>
<?php 
}
}
// Close connection
mysqli_close($db);
?>
</div>
</div>

</body>
</html>