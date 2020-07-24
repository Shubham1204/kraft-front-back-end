<?php

include "../controller/config.php"; 
session_start();
$searchvalue = htmlspecialchars($_GET["search"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
				 .card{
          width: 14rem;

				}
				@media screen and (min-width: 426px) and (max-width: 768px) {
				 .card{
					width: 14rem;
				}
			}
				@media screen and (min-width: 375px) and (max-width: 425px) {
					 .card{
					width: 16rem;
        }
        @media screen and (max-width: 376px) {
				 .card{
					width: 20rem;
				}
    }

			</style>
</head>
<body style="background-color: #EEF5F9">
<?php //include "header.php"; ?>
<?php include "sidebar.php"; ?>
<!-- <div class="content-inner"> -->
<center><h1 class="my-3 font-italic text-success">Search Products</h1></center>
   
<div class="row">
	<?php 
$sql = "select pid,pname,pdesc,pcost,discount from product_mst where pname LIKE '%$searchvalue%'";
$result = mysqli_query($db,$sql) or die("Bad query $sql");
$countrow = mysqli_num_rows($result); 
while($row = mysqli_fetch_assoc($result)){
            if($countrow<1){?>
                <center><h1 class="my-3 font-italic mx-auto">NO SEARCH RESULTS!!</h1></center>
           <?php }else{
    $searchproductid = "{$row['pid']}";
  $sql1="select imagepath from product_image_mst where productid={$row['pid']} LIMIT 1";
$result1 = mysqli_query($db,$sql1) or die("Bad query $sql1");
    // $discounted = $row['pcost']*($row['discount']/100);
    $cost=$row['pcost']; 
	$discount=$row['discount']; 
	$discountpercentage=($discount/100); 
	$disc=$discountpercentage*$cost; 
	$finalcost=$cost-$disc; 
// $discounted = $row['pcost']-($row['pcost']*$row['discount']/100);
?>
<div class="card mx-auto mb-4">
<?php while($row1 = mysqli_fetch_assoc($result1)){ ?>
<img src="<?php  echo "{$row1['imagepath']}" ?>" height="170px" class="card-img-top" alt="...">
<?php } ?>
  <div class="card-body">
	<h5 class="card-title"><?php echo "{$row['pname']}" ?></h5>
	<p class="card-text"><?php echo "{$row['pdesc']}" ?> <span class="float-right">₹<?php echo "{$finalcost}" ?></span></p>
    <a href='productpage.php?pid=<?php echo "{$row['pid']}"?>' class="btn btn-primary mx-auto">View Product</a>
  </div>
</div>
<?php } ?>
    <?php 
    $sql7="select catid from category_mst where catname LIKE '%$searchvalue%'";
    $result7 = mysqli_query($db,$sql7) or die("Bad query $sql7");
    while($row7 = mysqli_fetch_assoc($result7)){
$sql5 ="select pid,pname,pdesc,pcost,discount from product_mst,product_category_mapping where product_category_mapping.categoryid={$row7['catid']} and product_category_mapping.productid=product_mst.pid";
$result5 = mysqli_query($db,$sql5) or die("Bad query $sql5");
while($row5 = mysqli_fetch_assoc($result5)){
    // $searchproductid = "{$row5['pid']}";
  $sql6="select imagepath from product_image_mst where productid={$row5['pid']} LIMIT 1";
$result6 = mysqli_query($db,$sql6) or die("Bad query $sql6");
    // $discounted = $row['pcost']*($row['discount']/100);
    $cost=$row5['pcost']; 
	$discount=$row5['discount']; 
	$discountpercentage=($discount/100); 
	$disc=$discountpercentage*$cost; 
	$finalcost=$cost-$disc; 
// $discounted = $row['pcost']-($row['pcost']*$row['discount']/100);
?>
<div class="card mx-auto mb-4">
<?php while($row6 = mysqli_fetch_assoc($result6)){ ?>
<img src="<?php  echo "{$row6['imagepath']}" ?>" height="170px" class="card-img-top" alt="...">
<?php } ?>
  <div class="card-body">
	<h5 class="card-title"><?php echo "{$row5['pname']}" ?></h5>
	<p class="card-text"><?php echo "{$row5['pdesc']}" ?> <span class="float-right">₹<?php echo "{$finalcost}" ?></span></p>
    <a href='productpage.php?pid=<?php echo "{$row5['pid']}"?>' class="btn btn-primary mx-auto">View Product</a>
  </div>
</div>
<?php } } }
if($countrow<1){?>
    <center><h1 class="my-3 font-italic mx-5">NO SEARCH RESULTS!!</h1></center>
<?php }else{
    ?>
</div>


<h1 class="my-3 font-italic text-info mx-3">Recommended Products</h1>
<div class="row">
    <?php 
    $sql4="select username from user_mst,seller_product_mapping where user_mst.uid=seller_product_mapping.sellerid and seller_product_mapping.productid=$searchproductid";
    $result4 = mysqli_query($db,$sql4) or die("Bad query $sql4");
while($row4 = mysqli_fetch_assoc($result4)){
    $sql2 = "select pid,pname,pdesc,pcost,discount from product_mst,seller_product_mapping where product_mst.pid=seller_product_mapping.productid and seller_product_mapping.sellerid=(select uid from user_mst where username='{$row4['username']}')";
$result2 = mysqli_query($db,$sql2) or die("Bad query $sql2");
while($row2 = mysqli_fetch_assoc($result2)){
  $sql3="select imagepath from product_image_mst where productid={$row2['pid']} LIMIT 1";
$result3 = mysqli_query($db,$sql3) or die("Bad query $sql3");
    // $discounted = $row['pcost']*($row['discount']/100);
    $cost=$row2['pcost']; 
	$discount=$row2['discount']; 
	$discountpercentage=($discount/100); 
	$disc=$discountpercentage*$cost; 
	$finalcost=$cost-$disc; 
// $discounted = $row['pcost']-($row['pcost']*$row['discount']/100);
?>
<div class="card mx-auto mb-4">
<?php while($row3 = mysqli_fetch_assoc($result3)){ ?>
<img src="<?php  echo "{$row3['imagepath']}" ?>" height="170px" class="card-img-top" alt="...">
<?php } ?>
  <div class="card-body">
	<h5 class="card-title"><?php echo "{$row2['pname']}" ?></h5>
	<p class="card-text"><?php echo "{$row2['pdesc']}" ?> <span class="float-right">₹<?php echo "{$finalcost}" ?></span></p>
    <a href='productpage.php?pid=<?php echo "{$row2['pid']}"?>' class="btn btn-primary mx-auto">View Product</a>
  </div>
</div>
<?php } } ?>
</div>
<?php } ?>

</div>
</div>
</body>
</html>