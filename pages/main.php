<?php 
include "../controller/config.php"; 
session_start();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Kraft</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/cef3123337.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
   
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,500,900' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
			<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" style="height: 350px; width:100%">
    <div class="carousel-item active">
      <img class="d-block w-100" src="https://image.shutterstock.com/image-vector/left-right-human-brain-concept-260nw-671483350.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://www.brandknewmag.com/wp-content/uploads/2015/07/creative-way.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://iasbaba.com/wp-content/uploads/2015/07/Creative-Guidance-Word-Art.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<center><h1 class="my-3 font-italic text-success">Featured Products</h1></center>

<div class="row">
	<?php 
$sql = "select pid,pname,pdesc,pcost,discount from product_mst ORDER BY pid DESC LIMIT 9";
$result = mysqli_query($db,$sql) or die("Bad query $sql");
while($row = mysqli_fetch_assoc($result)){
$sql1="select imagepath from product_image_mst where productid={$row['pid']} LIMIT 1";
$result1 = mysqli_query($db,$sql1) or die("Bad query $sql1");

  // $discounted = $row['pcost']*($row['discount']/100);
	$cost=$row['pcost']; 
	$discount=$row['discount']; 
	$discountpercentage=($discount/100); 
	$disc=$discountpercentage*$cost; 
	$finalcost=$cost-$disc; 
	// echo "$finalcost"
// $discounted = $row['pcost']-($row['pcost']*$row['discount']/100);
?>
<!-- style="background: linear-gradient(#e9ebf5 0%, #dde2ed 100%)" -->
<div class="card mx-auto my-4" >
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
<center><a href="products.php"  class="btn btn-primary mx-auto">View All Products<br><i class="fas fa-angle-double-down"></i></a><span class="mx-4"></span><a href="category.php"  class="btn btn-primary mx-auto">View Categories<br><i class="fas fa-angle-double-down"></i></a></center>
</div>
<!-- </div> -->
<!-- </div> -->
<!-- <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/popper.js/umd/popper.min.js"> </script>
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
        <script src="../vendor/chart.js/Chart.min.js"></script>
        <script src="../vendor/jquery-validation/jquery.validate.min.js"></script>
        <script src="../js/charts-home.js"></script>
        <script src="../js/front.js"></script> -->
<?php mysqli_close($db); ?>
	</body>
</html>