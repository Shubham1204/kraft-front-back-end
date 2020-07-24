<?php 
include "../controller/config.php"; 
session_start();
if(isset($_SESSION["email"])){  
}
else{
    header( "location: notlogin.html");
}if($_SESSION['rolename']=="admin"){
    
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
    $sql = "select count(oid) as ordercount from order_mst";
    $result = mysqli_query($db,$sql) or die("Bad query $sql");
    while($row = mysqli_fetch_assoc($result)){
        $totalorder = "{$row['ordercount']}";
    }
    $sql1 = "select count(oid) as deliveredcount from order_mst where orderstatus='delivered'";
    $result1 = mysqli_query($db,$sql1) or die("Bad query $sql1");
    while($row1 = mysqli_fetch_assoc($result1)){
        $deliveredorder = "{$row1['deliveredcount']}";
    }
    $sql2 = "select count(oid) as ordercount from order_mst where orderstatus='shipped'";
    $result2 = mysqli_query($db,$sql2) or die("Bad query $sql2");
    while($row2 = mysqli_fetch_assoc($result2)){
    $shippedorder = "{$row2['ordercount']}";
    }
    $sql3 = "select count(oid) as ordercount from order_mst where orderstatus='processed'";
    $result3 = mysqli_query($db,$sql3) or die("Bad query $sql3");
    while($row3 = mysqli_fetch_assoc($result3)){
    $processedorder = "{$row3['ordercount']}";
    }
    $sql4 = "select count(uid) as customercount from user_mst,user_role_mapping,role_mst where user_mst.uid=user_role_mapping.userid and user_role_mapping.roleid=role_mst.roleid and role_mst.rolename='customer'";
    $result4 = mysqli_query($db,$sql4) or die("Bad query $sql4");
    while($row4 = mysqli_fetch_assoc($result4)){
        $customercount="{$row4['customercount']}";
    }
    $sql5 = "select count(uid) as sellercount from user_mst,user_role_mapping,role_mst where user_mst.uid=user_role_mapping.userid and user_role_mapping.roleid=role_mst.roleid and role_mst.rolename='seller'";
    $result5 = mysqli_query($db,$sql5) or die("Bad query $sql5");
    while($row5 = mysqli_fetch_assoc($result5)){
        $sellercount="{$row5['sellercount']}";
    }
    $sql6 = "select count(oid) as cancelledcount from order_mst where orderstatus='cancel'";
    $result6 = mysqli_query($db,$sql6) or die("Bad query $sql6");
    while($row6 = mysqli_fetch_assoc($result6)){
        $cancelcount="{$row6['cancelledcount']}";
    }

    $sql15 = "select count(pid) as productcount from product_mst ";
    $result15 = mysqli_query($db,$sql15) or die("Bad query $sql15");
    while($row15 = mysqli_fetch_assoc($result15)){
        $productcount="{$row15['productcount']}";
    }
    
    $sql7 = "select catname,description from category_mst";
    $result7 = mysqli_query($db,$sql7) or die("Bad query $sql7");

    $sql8 = "select dname,percentage,maxamount,lastdate,coupon from discount_mst";
    $result8 = mysqli_query($db,$sql8) or die("Bad query $sql8");

    $sql9 = "select rolename,description from role_mst";
    $result9 = mysqli_query($db,$sql9) or die("Bad query $sql9");

    
    $json=[];
    $json1=[];
    $sql12 = "select DISTINCT sellerid from seller_product_mapping";
    $result12 = mysqli_query($db,$sql12) or die("Bad query $sql12");
    while($row12 = mysqli_fetch_assoc($result12)){
      $sql14 = "select DISTINCT username from user_mst,seller_product_mapping where user_mst.uid=seller_product_mapping.sellerid and sellerid={$row12['sellerid']}";
      $result14 = mysqli_query($db,$sql14) or die("Bad query $sql14");
      while($row14 = mysqli_fetch_assoc($result14)){
        $sql13 = "select COUNT(productid) as countproducts from seller_product_mapping where sellerid={$row12['sellerid']}";
        $result13 = mysqli_query($db,$sql13) or die("Bad query $sql13");
        while($row13 = mysqli_fetch_assoc($result13)){
          //   $json[]=(int)$row12['sellerid'];
          $json[]=$row14['username'];
          $json1[]=(int)$row13['countproducts'];
        }
      }
    }
    
    $json2=[];
    $json3=[];
    $sql10 = "select DISTINCT categoryid from product_category_mapping";
    $result10 = mysqli_query($db,$sql10) or die("Bad query $sql10");
    while($row10 = mysqli_fetch_assoc($result10)){
      $sql16 = "select DISTINCT catname from category_mst,product_category_mapping where category_mst.catid=product_category_mapping.categoryid and categoryid={$row10['categoryid']}";
      $result16 = mysqli_query($db,$sql16) or die("Bad query $sql16");
      while($row16 = mysqli_fetch_assoc($result16)){
      $sql11 = "select COUNT(productid) as countproducts from product_category_mapping where categoryid={$row10['categoryid']}";
      $result11 = mysqli_query($db,$sql11) or die("Bad query $sql11");
      while($row11 = mysqli_fetch_assoc($result11)){
        // echo"{$row11['countproducts']}"; 
        $json2[]=$row16['catname'];
          $json3[]=(int)$row11['countproducts'];
      }
    }
  }
    
  $jso4=[];
$json5=[];
$sql17 = "select DISTINCT sellerid from seller_product_mapping";
$result17 = mysqli_query($db,$sql17) or die("Bad query $sql17");
while($row17 = mysqli_fetch_assoc($result17)){
    $sql18 = "select DISTINCT username from user_mst,seller_product_mapping where user_mst.uid=seller_product_mapping.sellerid and sellerid={$row17['sellerid']}";
$result18 = mysqli_query($db,$sql18) or die("Bad query $sql18");
while($row18 = mysqli_fetch_assoc($result18)){
  $sql19 = "select COUNT(oid) as countorders from order_mst,seller_product_mapping where order_mst.pid=seller_product_mapping.productid and sellerid={$row17['sellerid']}";
  $result19 = mysqli_query($db,$sql19) or die("Bad query $sql19");
  while($row19 = mysqli_fetch_assoc($result19)){
      $json4[]=$row18['username'];
      $json5[]=(int)$row19['countorders'];
}
}
}

    
    ?>
    <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <div class="row bg-white has-shadow">
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

                
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="fas fa-users"></i></div>
                    <div class="title"><span>Total<br>Customers</span>
                      <div class="progress">
                        <div role="progressbar" style="width: <?php echo"$customercount" ?>%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo"$customercount" ?></strong></div>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-red"><i class="fas fa-user-tag"></i></div>
                    <div class="title"><span>Total<br>Sellers</span>
                      <div class="progress">
                        <div role="progressbar" style="width: <?php echo"$sellercount" ?>%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo"$sellercount" ?></strong></div>
                  </div>
                </div>
                <!-- Item -->
        
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-green"><i class="fas fa-project-diagram"></i></div>
                    <div class="title"><span>Total<br>Products</span>
                      <div class="progress">
                        <div role="progressbar" style="width: <?php echo"$productcount" ?>%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo"$productcount" ?></strong></div>
                  </div>
                </div>
                <!-- Item -->
         
             
    
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
                    
                    <div class="text"><strong><?php echo"$totalorder" ?></strong><br><small>Total Orders</small></div>
                  </div>
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-yellow"><i class="fas fa-file-invoice"></i></div>
                    <div class="text"><strong><?php echo"$processedorder" ?></strong><br><small>New Orders</small></div>
                  </div>
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-red"><i class="fa fa-calendar-o"></i></div>
                    <div class="text"><strong><?php echo"$shippedorder" ?></strong><br><small>Shipped Orders</small></div>
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
                  <!-- Bar Chart   -->
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-orange"><i class="fa fa-paper-plane-o"></i></div>
                    <div class="text"><strong><?php echo"$deliveredorder" ?></strong><br><small>Delivered Orders</small></div>
                  </div>
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                  <div class="icon bg-red"><i class="fa fa-tasks"></i></div>
                    <div class="text"><strong><?php echo"$cancelcount" ?></strong><br><small>Cancelled Orders</small></div>
                  </div>
                  <!-- Numbers-->
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
          <section class="no-padding-top">
            <div class="conntainer-fluid">
              <div class="row mx-2">
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Categories</h3>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">  
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Description</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $counter=1;
                            while($row7 = mysqli_fetch_assoc($result7)){
                            ?>
                            <tr>
                              <th scope="row"><?php echo"$counter";?></th>
                              <td><?php echo"{$row7['catname']}";?></td>
                              <td><?php echo"{$row7['description']}";?></td> 
                            </tr>
                            <?php $counter=$counter+1; }?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                            </div>
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Category - Products</h3>
                    </div>
                    <div class="card-body">
                    <canvas id="categorychart"></canvas>
                    </div>
                  </div>
                </div>
                </div>
            </div>
          </section>

          <section class="no-padding-top">
            <div class="conntainer-fluid">
              <div class="row mx-2">
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Seller-Products</h3>
                    </div>
                    <div class="card-body">
                    <canvas id="sellerproductchart"></canvas>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Seller-Orders</h3>
                    </div>
                    <div class="card-body">
                    <canvas id="sellerorderchart"></canvas>
                    </div>
                  </div>
                </div>
                </div>
            </div>
          </section>

          <section class="no-padding-top">
            <div class="conntainer-fluid">
              <div class="row mx-2">
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Discount Coupons</h3>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">  
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Percentage</th>
                              <th>Max. Amount</th>
                              <th>Last Date</th>
                              <th>Coupon</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $counter=1;
                            while($row8 = mysqli_fetch_assoc($result8)){
                            ?>
                            <tr>
                              <th scope="row"><?php echo"$counter";?></th>
                              <td><?php echo"{$row8['dname']}";?></td>
                              <td><?php echo"{$row8['percentage']}";?></td>
                              <td><?php echo"{$row8['maxamount']}";?></td>
                              <td><?php echo"{$row8['lastdate']}";?></td>
                              <td><?php echo"{$row8['coupon']}";?></td>
                            </tr>
                            <?php $counter=$counter+1; }?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Roles</h3>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">  
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Description</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $counter=1;
                            while($row9 = mysqli_fetch_assoc($result9)){
                            ?>
                            <tr>
                              <th scope="row"><?php echo"$counter";?></th>
                              <td><?php echo"{$row9['rolename']}";?></td>
                              <td><?php echo"{$row9['description']}";?></td> 
                            </tr>
                            <?php $counter=$counter+1; }?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

                

              
          <!-- <script src="../js/charts-custom.js"></script>          -->
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
            label: 'My First dataset',
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
            data: [<?php echo"$productcount"?>,<?php echo"$shippedorder"?>,<?php echo"$deliveredorder"?>,<?php echo"$cancelcount"?>]
        }]
    },

    // Configuration options go here
    options: {}
});
          </script>


<script>
                var ctx = document.getElementById('categorychart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'polarArea',

    // The data for our dataset
    data: {
        labels: <?php echo json_encode($json2); ?>,
        datasets: [{
            label: 'My First dataset',
            // backgroundColor: 'rgb(255, 99, 132)',
            borderWidth: 0,
            backgroundColor: [
             '#58508D',"#64C2A6","#2D87BB",'#BC5090','#FF6361','#FFA600','#49cd8b',"#FEAE65", "#E6F69D","#AADEA7"
                // 'red','blue','green','pink'
                        // '#3eb579',
                        // '#49cd8b',
                        // "#54e69d",
                        // "#71e9ad"
                    ],
                    hoverBackgroundColor: [
                      '#58508D',"#64C2A6","#2D87BB",'#BC5090','#FF6361','#FFA600','#49cd8b',"#FEAE65", "#E6F69D","#AADEA7"
                      // '#3eb579',
                        // '#49cd8b',
                        // "#54e69d",
                        // "#71e9ad"
                    ],
            // borderColor: 'rgb(255, 99, 132)',
            data: <?php echo json_encode($json3); ?>
        }]
    },

    // Configuration options go here
    options: {}
});
          </script>

          <script>
                var ctx = document.getElementById('sellerproductchart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: <?php echo json_encode($json); ?>,
        datasets: [{
            label: 'My First dataset',
            // backgroundColor: 'rgb(255, 99, 132)',
            borderWidth: 0,
            backgroundColor: [
              'rgba(255, 99, 132)',
        'rgba(54, 162, 235)',
        'rgba(255, 206, 86)',
        'rgba(75, 192, 192)',
             '#58508D',"#64C2A6","#2D87BB",'#BC5090','#FF6361','#FFA600','#49cd8b',"#FEAE65", "#E6F69D","#AADEA7"
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
        'rgba(75, 192, 192)',
                      '#58508D',"#64C2A6","#2D87BB",'#BC5090','#FF6361','#FFA600','#49cd8b',"#FEAE65", "#E6F69D","#AADEA7"
                      // '#3eb579',
                        // '#49cd8b',
                        // "#54e69d",
                        // "#71e9ad"
                    ],
            // borderColor: 'rgb(255, 99, 132)',
            data: <?php echo json_encode($json1); ?>
        }]
    },

    // Configuration options go here
    options: {}
});
          </script>


<script>
                var ctx = document.getElementById('sellerorderchart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: <?php echo json_encode($json4); ?>,
        datasets: [{
            label: 'Orders',
            // backgroundColor: 'rgb(255, 99, 132)',
            borderWidth: 0,
            backgroundColor: [
             '#58508D',"#64C2A6","#2D87BB",'#BC5090','#FF6361','#FFA600','#49cd8b',"#FEAE65", "#E6F69D","#AADEA7"
                // 'red','blue','green','pink'
                        // '#3eb579',
                        // '#49cd8b',
                        // "#54e69d",
                        // "#71e9ad"
                    ],
                    hoverBackgroundColor: [
                     
                      '#58508D',"#64C2A6","#2D87BB",'#BC5090','#FF6361','#FFA600','#49cd8b',"#FEAE65", "#E6F69D","#AADEA7"
                      // '#3eb579',
                        // '#49cd8b',
                        // "#54e69d",
                        // "#71e9ad"
                    ],
            // borderColor: 'rgb(255, 99, 132)',
            data: <?php echo json_encode($json5); ?>
        }]
    },

    // Configuration options go here
    options: {}
});
          </script>

</body>

</html>