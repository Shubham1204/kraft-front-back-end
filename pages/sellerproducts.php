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
<center><h1 class="my-3 font-italic text-success">My Store Products</h1></center>
   
<div class="row">
	<?php 
$sql = "select pid,pname,pdesc,pcost,discount from product_mst,seller_product_mapping where product_mst.pid=seller_product_mapping.productid and seller_product_mapping.sellerid=(select uid from user_mst where email='{$_SESSION['email']}')";
$result = mysqli_query($db,$sql) or die("Bad query $sql");
$countrow = mysqli_num_rows($result); 
            if($countrow<1){
            ?>
            <center><h1 class="font-weigth-bold">-------------------------------You Don't have uploaded any Products yet!!--------------------------</h1></center>
            <?php
            }else{
while($row = mysqli_fetch_assoc($result)){
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
    <a href='updateproduct.php?pid=<?php echo "{$row['pid']}"?>' class="btn btn-primary mx-auto">Update Product</a>
  </div>
</div>
<?php } } ?>
</div> 
</div>
</div>
</body>
</html>