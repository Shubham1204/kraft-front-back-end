<?php 
include "../controller/config.php"; 
session_start();
if(isset($_SESSION["email"])){  
}
else{
    header( "location: notlogin.html");
}if($_SESSION['rolename']=="seller"){
    
}
else{
    header("location: notlogin.html");
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body style="background-color: #EEF5F9">
    <?php include "sidebar.php" ?>
    <?php 
    $sql = "select count(oid) as ordercount from order_mst,seller_product_mapping,user_mst where order_mst.pid=seller_product_mapping.productid and seller_product_mapping.sellerid=user_mst.uid and user_mst.uid=(select uid from user_mst where email='{$_SESSION['email']}')";
    $result = mysqli_query($db,$sql) or die("Bad query $sql");
    while($row = mysqli_fetch_assoc($result)){
        $totalorder = "{$row['ordercount']}";
    }
    $sql1 = "select count(oid) as deliveredcount from order_mst,seller_product_mapping,user_mst where orderstatus='delivered' and order_mst.pid=seller_product_mapping.productid and seller_product_mapping.sellerid=user_mst.uid and user_mst.uid=(select uid from user_mst where email='{$_SESSION['email']}')";
    $result1 = mysqli_query($db,$sql1) or die("Bad query $sql1");
    while($row1 = mysqli_fetch_assoc($result1)){
        $deliveredorder = "{$row1['deliveredcount']}";
    }
    $sql2 = "select count(oid) as ordercount from order_mst,seller_product_mapping,user_mst where orderstatus='shipped' and order_mst.pid=seller_product_mapping.productid and seller_product_mapping.sellerid=user_mst.uid and user_mst.uid=(select uid from user_mst where email='{$_SESSION['email']}')";
    $result2 = mysqli_query($db,$sql2) or die("Bad query $sql2");
    while($row2 = mysqli_fetch_assoc($result2)){
    $shippedorder = "{$row2['ordercount']}";
    }
    $sql3 = "select count(oid) as ordercount from order_mst,seller_product_mapping,user_mst where orderstatus='processed' and order_mst.pid=seller_product_mapping.productid and seller_product_mapping.sellerid=user_mst.uid and user_mst.uid=(select uid from user_mst where email='{$_SESSION['email']}')";
    $result3 = mysqli_query($db,$sql3) or die("Bad query $sql3");
    while($row3 = mysqli_fetch_assoc($result3)){
    $processedorder = "{$row3['ordercount']}";
    }
    $sql6 = "select count(oid) as cancelledcount from order_mst,seller_product_mapping,user_mst where orderstatus='cancel' and order_mst.pid=seller_product_mapping.productid and seller_product_mapping.sellerid=user_mst.uid and user_mst.uid=(select uid from user_mst where email='{$_SESSION['email']}')";
    $result6 = mysqli_query($db,$sql6) or die("Bad query $sql6");
    while($row6 = mysqli_fetch_assoc($result6)){
        $cancelcount="{$row6['cancelledcount']}";
    }
    $json=[$processedorder,$shippedorder,$deliveredorder,$cancelcount];
    ?>
    <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="fas fa-receipt"></i></div>
                    <div class="title"><span>New<br>Orders</span>
                      <div class="progress">
                        <div role="progressbar" style="width: <?php echo"$processedorder" ?>%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo"$processedorder" ?></strong></div>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-red"><i class="fas fa-file-invoice"></i></div>
                    <div class="title"><span>Shipped<br>Orders</span>
                      <div class="progress">
                        <div role="progressbar" style="width: <?php echo"$shippedorder" ?>%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo"$shippedorder" ?></strong></div>
                  </div>
                </div>
                <!-- Item -->
        
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-green"><i class="fas fa-file-invoice-dollar"></i></div>
                    <div class="title"><span>Delivered<br>Orders</span>
                      <div class="progress">
                        <div role="progressbar" style="width: <?php echo"$deliveredorder" ?>%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo"$deliveredorder" ?></strong></div>
                  </div>
                </div>
                <!-- Item -->
         
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-orange"><i class="fas fa-file-invoice"></i></div>
                    <div class="title"><span>Total<br>Orders</span>
                      <div class="progress">
                        <div role="progressbar" style="width: <?php echo"$totalorder" ?>%; height: 4px;" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo"$totalorder" ?></strong></div>
                  </div>
                </div>
    
              </div>
            </div>
          </section>
          <section class="dashboard-header">
            <div class="container-fluid">
              <div class="row">
                <!-- Statistics -->
                <div class="statistics col-lg-3 col-12">
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                  <div class="icon bg-blue"><i class="fa fa-paper-plane-o"></i></div>
                    
                    <div class="text"><strong><?php echo"$totalorder" ?></strong><br><small>Orders</small></div>
                  </div>
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                  <div class="icon bg-red"><i class="fa fa-tasks"></i></div>
                    <div class="text"><strong><?php echo"$cancelcount" ?></strong><br><small>Cancelled Orders</small></div>
                  </div>
                </div>
                <!-- dougnout -->
                <div class="col-lg-6 col-12">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Orders</h3>
                    </div>
                    <div class="card-body">
                      <canvas id="orderschart"></canvas>
                    </div>
                  </div>
                </div>
                <div class="chart col-lg-3 col-12">
                  <?php
                //   total-cancel
                    $successrate =$totalorder-$cancelcount ;
                    $successdivide= $successrate/$totalorder;
                    $sucesspercent = $successdivide*100;
                ?>
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-green"><i class="fa fa-line-chart"></i></div>
                    <div class="text"><strong><?php echo round($sucesspercent,2); ?>%</strong><br><small>Success Rate</small></div>
                  </div>
                </div>
              </div>
            </div>
          </section>


          <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
         
         <script>
                var ctx = document.getElementById('orderschart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'doughnut',

    // The data for our dataset
    data: {
        labels: ['New', 'Shipped','Delivered','Cancelled'],
        datasets: [{
            label: 'order',
            // backgroundColor: 'rgb(255, 99, 132)',
            borderWidth: 0,
            backgroundColor: [
              'rgba(255, 99, 132)',
        'rgba(54, 162, 235)',
        'rgba(255, 206, 86)',
        'rgba(75, 192, 192)'
                // 'red','blue','green','pink'
                        // '#3eb579',
                        // '#49cd8b',
                        // "#54e69d",
                        // "#71e9ad"
                    ],
                    hoverBackgroundColor: [
                      'rgba(255, 99, 132)',
        'rgba(54, 162, 235)',
        'rgba(255, 206, 86)',
        'rgba(75, 192, 192)' 
                      // '#3eb579',
                        // '#49cd8b',
                        // "#54e69d",
                        // "#71e9ad"
                    ],
            // borderColor: 'rgb(255, 99, 132)',
            data: <?php echo json_encode($json); ?>
        }]
    },

    // Configuration options go here
    options: {}
});
          </script>
</body>
</html>