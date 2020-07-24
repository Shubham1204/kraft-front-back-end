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
}
$totalsum=0;
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Cart</title>

  <!-- Font Awesome -->
 <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"> -->

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
  <!-- Material Design Bootstrap -->
  <link href="../css/mdb1.min.css" rel="stylesheet">

  <!-- Custom style cart-v1-->
  <style>
    @media only screen and (max-width: 768px) {

/* Force table to not be like tables anymore */
table,
thead,
tbody,
th,
td,
tr {
  display: block;
  text-align: center;
}
table.table td {
  padding-top: 1.5rem;
  padding-bottom: .4rem;

}
/* Hide table headers (but not display: none;, for accessibility) */
thead tr {
  position: absolute;
  top: -9999px;
  left: -9999px;
}

img {
  display: block;
  margin: 0 auto;
}
td {
  /* Behave  like a "row" */
  border: none;
  position: relative;
  padding-left: 50%;

}

td:before {
  /* Now like a table header */
  position: absolute;
  /* Top/left values mimic padding */
  top: 6px;
  left: 6px;
  white-space: nowrap;
}

td:nth-of-type(1):before {
  content: "Product";
  font-weight: 400;
  left: 50%;
  transform: translate(-50%);
}
td:nth-of-type(2):before {
  content: "Color";
  font-weight: 400;
  left: 50%;
  transform: translate(-50%);
}
td:nth-of-type(3) {
  position: absolute;
  border: none !important;
}
td:nth-of-type(4):before {
  content: "Price";
  left: 50%;
  transform: translate(-50%);
  font-weight: 400;
}
td:nth-of-type(5):before {
  content: "QTY";
  left: 50%;
  transform: translate(-50%);
  font-weight: 400;
}
td:nth-of-type(5) {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  padding-top: 1.9rem !important;
}
td:nth-of-type(6):before {
  content: "Amount";
  left: 50%;
  transform: translate(-50%);
  font-weight: 400;
}
td:nth-of-type(7):before {
  content: "Remove item";
  left: 50%;
  transform: translate(-50%);
  font-weight: 400;
}
.btn-group {
  margin-left: 0 !important;
}
tr:nth-child(4) td:nth-of-type(4):before,
tr:nth-child(4) td:nth-of-type(1):before,
tr:nth-child(4) td:nth-of-type(2):before {
  content: '';
}
tr:nth-child(4) td:nth-of-type(1) {
  position: absolute;
  border: none !important;
}
tr:nth-child(4) td:nth-of-type(3) {
  position: relative;
  display: flex;
  justify-content: center;
}
tr:nth-child(4) td:nth-of-type(4) {
  border-top: none !important;
  display: flex;
  justify-content: center;
  border-bottom : 1px solid #dee2e6;
}

}
    </style>
</head>

<body class="cart-v1 hidden-sn animated">
<?php //include "header.php"; ?>
<?php include "sidebar.php"; ?>
<!-- <div class="content-inner"> -->
      


  <!--Main Layout-->
  <!-- <main> -->
    <center><h1 class="text-primary mt-4">Cart Page</h1></center>
<?php 
	$random = rand(10000000,99999999999999999);
$sql = "select pid,pname,expecteddeliverdate,discount,pcost,shippingcost,sellername from product_mst,user_mst,user_cart_mapping,product_seller_cart_mapping where product_seller_cart_mapping.productid=product_mst.pid and product_seller_cart_mapping.cartid=user_cart_mapping.cartid and user_cart_mapping.userid=user_mst.uid and user_mst.email='{$_SESSION['email']}'";
$result = mysqli_query($db,$sql) or die("Bad query $sql");
$countrow = mysqli_num_rows($result); 
?>
    <!-- Main Container -->
    <div class="container">
      <form action="checkout.php" method="post">

      <section class="section my-5 pb-5">

            <?php 
            if($countrow<1){
            ?>
            <center><h1 class="font-weigth-bold">----------------Cart is empty-----------------</h1></center>
            <?php
            }else{
            ?>
        <!-- Shopping Cart table -->
        <div class="table-responsive">
          
          <table class="table product-table">
            <!-- Table head -->
            <thead>
              <tr>
                <!-- <th></th> -->
                <th class="font-weight-bold">
                  <strong>Product</strong>
                </th>
                <th></th>
                <th class="font-weight-bold">
                  <strong>Price</strong>
                </th>
                <th class="font-weight-bold">
                  <strong>Shipping</strong>
                </th>
                
                
                <th class="font-weight-bold">
                  <strong>Amount</strong>
                </th>
                <th></th>
              </tr>
            </thead>
            <!-- /.Table head -->

            <!-- Table body -->
            <tbody>
              <?php 
              while($row = mysqli_fetch_assoc($result)){
                $sql1="select imagepath from product_image_mst where productid={$row['pid']} LIMIT 1";
                $result1 = mysqli_query($db,$sql1) or die("Bad query $sql1");
                 
                // if(mysqli_num_rows($result) <=0){
                  // echo "empty";
                // }
              ?>
              <!-- First row -->
              <tr>
                <th scope="row">
                <?php while($row1 = mysqli_fetch_assoc($result1)){ ?>
                  <img src="<?php echo "{$row1['imagepath']}" ?>" alt="" class="img-fluid z-depth-0">
                  <?php } ?>
                </th>
                <td>
                  <h5 class="mt-3">
                    <strong><?php echo "{$row['pname']}" ?></strong>
                  </h5>
                  <p class="text-muted">Kraft Work</p>
                  <p class="text-muted">by <?php echo "{$row['sellername']}" ?></p>
                </td>
                <?php $cost=$row['pcost']; $discount=$row['discount']; $discountpercentage=($discount/100); $disc=$discountpercentage*$cost; $finalcost=$cost-$disc; ?>
                <td>₹<?php echo "$finalcost" ?></td>
                
                <td>₹<?php echo "{$row['shippingcost']}" ?></td>
                
                <?php  $total=$finalcost+$row['shippingcost']; ?>
                <td class="font-weight-bold">
                    <?php $totalsum=$totalsum+$total;  ?>
                <strong>₹<?php echo"{$total}" ?></strong>
                </td>
                <td>
                  <?php $productid=$row['pid']; ?>
                  <?php
                  $sql1="INSERT INTO dummy_order_mst(USERID, random,pid, expectedate, totalamount, totalshipping) VALUES ((select uid from user_mst where user_mst.email='{$_SESSION['email']}'),$random,$productid,{$row['expecteddeliverdate']},{$total},{$row['shippingcost']})";
                  $result1 = mysqli_query($db,$sql1) or die("Bad query $sql1");
                  if($result1){$_SESSION['randomoid'] = $random;}
                  ?>

                  <a type="button" class="btn btn-sm btn-primary text-white" data-toggle="tooltip" data-placement="top" title="Remove item" href="../controller/removeproductfromcartcontroller.php?pid=<?php echo"$productid"?>">Remove
</a>
                </td>
              </tr>
              <!-- /.First row -->
<?php } ?>
</tbody>
<!-- /.Table body -->
</table>
<div class="text-right mr-5 mb-2"><span  class="font-weight-bold">Total: </span>₹<?php echo"{$totalsum}"; ?></div>
<input type="hidden" name="sum" value="<?php echo"{$totalsum}" ?>">
          <div colspan="12" class="text-right">
            <button type="submit" class="btn btn-primary btn-rounded">Complete purchase
              <i class="fas fa-angle-right right"></i>
            </button>
          </div>
          
          <?php } ?>
          
        </div>
        <!-- Shopping Cart table -->

      </section>
      </form>
    </div>
    <!-- /Main Container -->
  <!-- </main> -->
  <!--Main Layout-->
</div>
                </div>
  <?php
// Close connection
mysqli_close($db);
  ?>

  <!-- SCRIPTS -->

 
  <script type="text/javascript">
    /* WOW.js init */
    new WOW().init();

    // MDB Lightbox Init
    $(function () {
      $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
    });

    // Tooltips Initialization
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    // SideNav Initialization
    $(".button-collapse").sideNav();

    // Material Select Initialization
    $(document).ready(function () {
      $('.mdb-select').material_select();
    });

  </script>

</body>

</html>