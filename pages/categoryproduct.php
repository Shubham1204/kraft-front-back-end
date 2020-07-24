<?php 
include "../controller/config.php"; 
session_start();
$categoryid = htmlspecialchars($_GET["catid"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
				div .card{
					width: 16rem;
				}
				@media (max-width: 768px) {
					div .card{
					width: 12rem;
				}
			}
				@media (max-width: 425px) {
					div .card{
					width: 8rem;
				}
    }

			</style>
    <title>Products</title>
</head>
<body>
<?php //include "header.php"; ?>
<?php include "sidebar.php"; ?>
<!-- <div class="content-inner"> -->
<center><h1 class="my-3 font-italic text-success">Featured Products</h1></center>
<div class="row">
    <?php 
$sql = "select pid,pname,pdesc,pcost,discount from product_mst,product_category_mapping where product_category_mapping.categoryid=$categoryid and product_category_mapping.productid=product_mst.pid";
$result = mysqli_query($db,$sql) or die("Bad query $sql");
while($row = mysqli_fetch_assoc($result)){
$sql1="select imagepath from product_image_mst where productid={$row['pid']} LIMIT 1";
$result1 = mysqli_query($db,$sql1) or die("Bad query $sql1");

	$cost=$row['pcost']; 
	$discount=$row['discount']; 
	$discountpercentage=($discount/100); 
	$disc=$discountpercentage*$cost; 
	$finalcost=$cost-$disc; 
	// $discounted = $row['pcost']*($row['discount']/100);
?>
<div class="card mx-auto mb-4" style="background: linear-gradient(#e9ebf5 0%, #dde2ed 100%)">
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
</div> 
</div>
</div>
</body>
</html>