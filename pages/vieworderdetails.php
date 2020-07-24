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
    <link rel="stylesheet" href="../css/orderdetails.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body style="background-color: #EEF5F9">
    <?php include "sidebar.php"; ?>
    <?php
    $productid = htmlspecialchars($_GET["pid"]);
    $orderid = htmlspecialchars($_GET["oid"]);
    $orderdate = htmlspecialchars($_GET["odate"]);
    // echo "{$productid} {$orderid} {$orderdate}";
    $sql = "SELECT orderstatus, orderdate, order_mst.pid,pname,pcost,discount,imagepath,returnpolicy, expecteddate, amount, order_mst.shippingcost, paymentmethod,transactionid, time,custname,custemail,address,address1,city,state,pincode,addresstype FROM order_mst,product_mst,product_image_mst,customer_address_mst WHERE product_mst.pid=order_mst.pid and order_mst.pid=product_image_mst.productid and customer_address_mst.orderid=order_mst.orderid and order_mst.orderid='$orderid' and order_mst.orderdate='$orderdate' and order_mst.orderid='$orderid' and order_mst.custid=(select uid from user_mst where email='{$_SESSION['email']}') LIMIT 1";
    $result = mysqli_query($db, $sql) or die("Bad query $sql");
    while ($row = mysqli_fetch_assoc($result)) {
        // sql1="";
    ?>
        <div class="container d-flex justify-content-center">
            <div class="container-fluid">
                <center>
                    <h1 class="my-4"><?php echo "{$row['pname']}" ?></h1>
                </center>
                <h6>Item Details</h6>
                <div class="row" style=" border-bottom: 1px solid rgba(0, 0, 0, .2);
    padding: 2vh 0 2vh 0;
    justify-content: space-between;
    flex-wrap: unset;
    margin: 0;">
                    <div class="col-6"> <img class="img-fluid" src="<?php echo "{$row['imagepath']}" ?>"> </div>
                </div>
                <h6>Order Details</h6>
                <div class="row" style=" border-bottom: 1px solid rgba(0, 0, 0, .2);
    padding: 2vh 0 2vh 0;
    justify-content: space-between;
    flex-wrap: unset;
    margin: 0;">
                    <div class="col-xs-6">
                        <ul type="none" style="  padding: 0;
    display: flex;
    flex-direction: column;
    justify-content: space-around">
                            <li class="left" style="float: left;
        font-weight: normal;
    color: rgb(126, 123, 123);">Order number:</li>
                            <li class="left" style="float: left;
        font-weight: normal;
    color: rgb(126, 123, 123);">Date:</li>
                            <li class="left" style="float: left;
        font-weight: normal;
    color: rgb(126, 123, 123);">Price:</li>
                            <li class="left" style="float: left;
        font-weight: normal;
    color: rgb(126, 123, 123);">Discount:</li>
                            <li class="left" style="float: left;
        font-weight: normal;
    color: rgb(126, 123, 123);">Shipping:</li>
                            <li class="left" style="float: left;
        font-weight: normal;
    color: rgb(126, 123, 123);">Total Price:</li>
                        </ul>
                    </div>
                    <?php $expecteddate = $row['expecteddate'];
                    ?>
                    <div class="col-xs-6">
                        <ul class="right" type="none" style="  padding: 0;
    display: flex;
    flex-direction: column;
    justify-content: space-around">
                            <li class="right" style="float: right;
    text-align: right;">#<?php echo "{$orderid}" ?></li>
                            <li class="right text-muted" style="float: right;
    text-align: right;"><?php echo "{$orderdate}" ?></li>
                            <li class="right text-muted" style="float: right;
    text-align: right;">₹ <?php echo "{$row['pcost']}" ?></li>
                            <li class="right text-muted" style="float: right;
    text-align: right;"><?php echo "{$row['discount']}" ?>%</li>
                            <li class="right text-muted" style="float: right;
    text-align: right;">₹ <?php echo "{$row['shippingcost']}" ?></li>
                            <li class="right" style="float: right;
    text-align: right;">₹ <?php echo "{$row['amount']}" ?></li>
                        </ul>
                    </div>
                </div>
                <h6>Shipment Details</h6>
                <div class="row" style=" border-bottom: 1px solid rgba(0, 0, 0, .2);
    padding: 2vh 0 2vh 0;
    justify-content: space-between;
    flex-wrap: unset;
    margin: 0;">
                    <div class="col-xs-6">
                        <ul type="none" style="  padding: 0;
    display: flex;
    flex-direction: column;
    justify-content: space-around">
                            <li class="left" style="float: left;
        font-weight: normal;
    color: rgb(126, 123, 123);">Name: </li>
                            <li class="left" style="float: left;
        font-weight: normal;
    color: rgb(126, 123, 123);">Email: </li>
                            <li class="left" style="float: left;
        font-weight: normal;
    color: rgb(126, 123, 123);">Address Line1: </li>
                            <li class="left" style="float: left;
        font-weight: normal;
    color: rgb(126, 123, 123);">Address Line2: </li>
                            <li class="left" style="float: left;
        font-weight: normal;
    color: rgb(126, 123, 123);">City: </li>
                            <li class="left" style="float: left;
        font-weight: normal;
    color: rgb(126, 123, 123);">State: </li>
                            <li class="left" style="float: left;
        font-weight: normal;
    color: rgb(126, 123, 123);">Pincode: </li>
                            <li class="left" style="float: left;
        font-weight: normal;
    color: rgb(126, 123, 123);">Address Type: </li>
                        </ul>
                    </div>
                    <div class="col-xs-6">
                        <ul type="none" style="  padding: 0;
    display: flex;
    flex-direction: column;
    justify-content: space-around">
                            <li class="right" style="float: right;
    text-align: right;"><?php echo "{$row['custname']}"  ?></li>
                            <li class="right" style="float: right;
    text-align: right;"><?php echo "{$row['custemail']}"  ?></li>
                            <li class="right" style="float: right;
    text-align: right;"><?php echo "{$row['address']}"  ?></li>
                            <li class="right" style="float: right;
    text-align: right;"><?php echo "{$row['address1']}"  ?></li>
                            <li class="right" style="float: right;
    text-align: right;"><?php echo "{$row['city']}"  ?></li>
                            <li class="right" style="float: right;
    text-align: right;"><?php echo "{$row['state']}"  ?></li>
                            <li class="right" style="float: right;
    text-align: right;"><?php echo "{$row['pincode']}"  ?></li>
                            <li class="right text-uppercase" style="float: right;
    text-align: right;"><?php echo "{$row['addresstype']}"  ?></li>

                        </ul>
                    </div>
                </div>
                <h6>Payment Details</h6>
                <div class="row" style=" border-bottom: 1px solid rgba(0, 0, 0, .2);
    padding: 2vh 0 2vh 0;
    justify-content: space-between;
    flex-wrap: unset;
    margin: 0;" style="border-bottom: none">
                    <div class="col-xs-6">
                        <ul type="none" style="  padding: 0;
    display: flex;
    flex-direction: column;
    justify-content: space-around">
                            <li class="left" style="float: left;
        font-weight: normal;
    color: rgb(126, 123, 123);">Payment Method:</li>
                            <li class="left" style="float: left;
        font-weight: normal;
    color: rgb(126, 123, 123);">Transaction Id:</li>
                            <li class="left" style="float: left;
        font-weight: normal;
    color: rgb(126, 123, 123);">Transaction Time:</li>
                        </ul>
                    </div>

                    <div class="col-xs-6">
                        <ul class="right" type="none" style="  padding: 0;
    display: flex;
    flex-direction: column;
    justify-content: space-around">
                            <li class="right text-uppercase" style="float: right;
    text-align: right;"><?php echo "{$row['paymentmethod']}" ?></li>
                            <li class="right" style="float: right;
    text-align: right;">#<?php echo "{$row['transactionid']}" ?></li>
                            <li class="right" style="float: right;
    text-align: right;"><?php echo "{$row['time']}" ?></li>
                        </ul>
                    </div>
                </div>
                <h6>Tracking Details</h6>
                <div class="row" style="
    padding: 2vh 0 2vh 0;
    justify-content: space-between;
    flex-wrap: unset;
    margin: 0; border-bottom: none;">
                    <div class="col">
                        <div class="card">
                            <div class="row d-flex justify-content-between px-5 top">
                                <div class="d-flex">
                                    <h5>ORDER ID: <span class="text-primary font-weight-bold">#<?php echo "{$orderid}" ?></span></h5>
                                </div>
                                <div class="d-flex flex-column text-sm-right">


                                    <p class="mb-0">Expected Arrival <span class=" font-weight-bold"><?php echo date('d-m-Y', strtotime($orderdate . ' + ' . $expecteddate . ' days')); ?></span></p>
                                </div>
                            </div> <!-- Add class 'active' to progress -->
                            <div class="row d-flex justify-content-center">
                                <div class="col-12">
                                    <ul id="progressbar" class="text-center">
                                        <?php $ostatus = "{$row['orderstatus']}";

                                        if ($ostatus == "processed") { ?>
                                            <li class="active step0"></li>
                                            <li class=" step0"></li>
                                            <li class=" step0"></li>
                                            <li class="step0"></li>
                                        <?php  } else if ($ostatus == "shipped") { ?>
                                            <li class="active step0"></li>
                                            <li class="active step0"></li>
                                            <li class=" step0"></li>
                                            <li class="step0"></li>
                                        <?php  } else if ($ostatus == "enrute") { ?>
                                            <li class="active step0"></li>
                                            <li class="active step0"></li>
                                            <li class="active step0"></li>
                                            <li class="step0"></li>
                                        <?php } else if ($ostatus == "delivered") { ?>
                                            <li class="active step0"></li>
                                            <li class="active step0"></li>
                                            <li class="active step0"></li>
                                            <li class="active step0"></li>
                                        <?php } else if ($ostatus == "cancel") { ?>
                                            <li class="step0"></li>
                                            <li class="step0"></li>
                                            <li class="step0"></li>
                                            <li class="step0"></li>
                                        <?php }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="row justify-content-between top">
                                <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/9nnc9Et.png">
                                    <div class="d-flex flex-column">
                                        <p class="font-weight-bold">Order<br>Processing</p>
                                    </div>
                                </div>
                                <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/u1AzR7w.png">
                                    <div class="d-flex flex-column">
                                        <p class="font-weight-bold">Order<br>Shipped</p>
                                    </div>
                                </div>
                                <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/TkPm63y.png">
                                    <div class="d-flex flex-column">
                                        <p class="font-weight-bold">Order<br>En Route</p>
                                    </div>
                                </div>
                                <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/HdsziHP.png">
                                    <div class="d-flex flex-column">
                                        <p class="font-weight-bold">Order<br>Delivered</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col my-auto border-line">
                <?php if($ostatus=="cancel"){ ?>
                <center><h6 class="text-danger">Order Cancelled!</h6></center> <?php } ?>
                    <?php if($ostatus=="shipped" || $ostatus=="enrute" || $ostatus=="delivered"){ ?>
                        <center><h6>Sorry Can't Cancel Order Since it's already <?php echo"$ostatus" ?>!</h6>
                   <h5 class="btn btn-danger disabled" >Cancel Order!</h5></center>
                    <?php }else if($ostatus=="processed"){ ?>
                        <center><h5 type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Cancel Order!</h5></center>
                       
    
      <!-- Modal content-->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Cancel Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Order Id: <strong>#<?php echo "{$orderid}" ?></strong>
        <br> 
        Product Name: <strong><?php echo "{$row['pname']}" ?></strong>
        <br>
        Total Amount: <strong>₹  <?php echo "{$row['amount']}" ?></strong>
        <br><br>
        Do you really want to Cancel the order. <strong>Press Cancel to Cancel the order..</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Don't Cancel</button>
        <a href="../controller/cancelordercontroller.php?oid=<?php echo"{$orderid}" ?>&pid=<?php echo"{$productid}" ?>&odate=<?php echo"{$orderdate}"?>"><button type="button" class="btn btn-danger">Cancel</button></a>
      </div>
    </div>
  </div>
</div>
  
                        <?php } ?>
           
                </div>
            </div>
        </div>
    <?php } ?>
</body>

</html>