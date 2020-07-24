<?php 
include "../controller/config.php"; 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    
    <link href="https://getbootstrap.com/docs/3.3/examples/carousel/carousel.css" rel="stylesheet">
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- Material Design Bootstrap -->
  <link href="../css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="../css/style.min.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <!-- <link rel="stylesheet" href="../"> -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
  <script src="https://kit.fontawesome.com/cef3123337.js" crossorigin="anonymous"></script>
    <style>
        a{
            text-decoration: none;
        }
  img { border-radius:5px;}
		.poster-main{
			position: relative;
      margin:30px auto;
      max-width:1000px;
		}
		.poster-main .poster-list .poster-item{
			position: absolute;
			left: 0;
			top: 0;
		}
		.poster-main .poster-btn{
			position: absolute;
			top: 0;
			cursor: pointer;
		}
		.poster-main .poster-prev-btn{
			left: 0;
			background: url("../images/btn_l.png") no-repeat center center;
		}
		.poster-main .poster-next-btn{
			right: 0;
			background: url("../images/btn_r.png") no-repeat center center;
		}
		
	</style> 
</head>
<body>
<?php //include "header.php"; ?>
<?php include "sidebar.php"; ?>
<!-- <div class="content-inner"> -->
<?php
$productid = htmlspecialchars($_GET["pid"]);
$sql = "select pid,pname,pdesc,pcost,expecteddeliverdate,discount,shippingcost,ptype,returnpolicy,category_mst.catname,user_mst.username from product_mst,user_mst,seller_product_mapping,category_mst,product_category_mapping where seller_product_mapping.sellerid=user_mst.uid and seller_product_mapping.productid=product_mst.pid and product_category_mapping.productid=product_mst.pid and product_category_mapping.categoryid=category_mst.catid and product_mst.pid=$productid";
$result = mysqli_query($db,$sql) or die("Bad query $sql");
while($row = mysqli_fetch_assoc($result)){
  $sql1="select imagepath from product_image_mst where productid={$row['pid']}";
  // $result1 = mysqli_query($db,$sql1) or die("Bad query $sql1");
  
?>
   <div class="col-md-6 float-left row ml-5 mt-5">
   <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height: 550px; width: 500px;">
   <!-- <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel"  > -->
    <ol class="carousel-indicators">
    <?php
    //  echo make_slide_indicators();
     $count = 0;
     $result1 = mysqli_query($db,$sql1) or die("Bad query $sql1");
     while($row1 = mysqli_fetch_array($result1))
     {
      if($count == 0)
      {
    ?>
      <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo"{$count}"?>" class="active"></li>
       <!-- <li data-target="#dynamic_slide_show" data-slide-to="<?php echo"{$count}"?>" class="active"></li> -->
    <?php
      }
  else
  { ?>
  <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo"{$count}"?>"></li>
  <!-- <li data-target="#dynamic_slide_show" data-slide-to="<?php echo"{$count}"?>"></li> -->
  <?php 
  }
  $count = $count + 1;
 } ?>
    </ol>

    <div class="carousel-inner">
     <?php
      $count = 0;
      $result1 = mysqli_query($db,$sql1) or die("Bad query $sql1");
      while($row1 = mysqli_fetch_array($result1))
      {
       if($count == 0)
       {
     ?>
    <div class="carousel-item active">
    <a href="<?php echo"{$row1["imagepath"]}"?>">
     <img class="d-block w-100" src="<?php echo"{$row1["imagepath"]}"?>" alt="<?php echo"{$row1["imagepath"]}"?>"  style="height: 100%; width:100%;" />
    </a>
     <!-- <div class="carousel-caption">
    <h3><?php //echo"{$row["pname"]}"?></h3>
   </div> -->
       </div>
       <?php
        $count = $count + 1;
    }else{
         ?>
        <div class="carousel-item">
          <a href="<?php echo"{$row1["imagepath"]}"?>">
        <img class="d-block w-100" src="<?php echo"{$row1["imagepath"]}"?>" alt="<?php echo"{$row1["imagepath"]}"?>"  style="height:100%; width:100%;" />
          </a>
        <!-- <div class="carousel-caption">
    <h3><?php //echo"{$row1["imagepath"]}"?></h3>
   </div> -->
       </div>
      <?php 
      $count = $count + 1;
      }
       } 
     ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
    <span class="sr-only">Next</span>
  </a>
    <!-- <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
     <span class="glyphicon glyphicon-chevron-left"></span>
     <span class="sr-only">Previous</span>
    </a>

    <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
     <span class="glyphicon glyphicon-chevron-right"></span>
     <span class="sr-only">Next</span>
    </a> -->

   </div>
      </div>

     
    <!-- <div class="col-md-5 float-left row ml-2 mt-5">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="item">
      <?php //while($row1 = mysqli_fetch_assoc($result1)){ ?>
        <a href="<?php //echo "{$row1['imagepath']}" ?>">
          <img src="<?php //echo "{$row1['imagepath']}" ?>" alt="img" style="width:400px;">
          <?php //} ?>
      </a>
      </div>

    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
    </div>
    </div> -->
<!-- <div class="poster-main" id="carousel" data-setting='{
							"width":600,
							"height":300,
							"posterWidth":400,
							"posterHeight":300,
							"scale":0.8,
							"speed":1000,
							"autoPlay":true,
							"delay":1000,
							"verticalAlign":"middle"
							}'> 
   <div class="poster-btn poster-prev-btn"></div> 
   <ul class="poster-list"> 
    <li class="poster-item"><a href="<?php echo "{$row['imagepath']}" ?>"><img src="<?php echo "{$row['imagepath']}" ?>" alt="" width="100%" /></a></li> 

   </ul> 
   <div class="poster-btn poster-next-btn"></div> 
  </div>  -->
  <!-- </div></div> -->
  <div class="col-md-5 float-right mt-4">
  <div class="p-4">
  <h3 class="font-weight-bold text-uppercase"><?php echo "{$row['pname']}" ?></h3>
  <p>by <?php echo "{$row['username']}" ?></p>
<div class="mb-3">
  <a href="">
    <span class="badge purple mr-1"><?php echo "{$row['catname']}" ?></span>
</a>
        <a href="">
          <span class="badge brown text-capitalize mr-1"><?php echo "{$row['ptype']}" ?> Product</span>
        </a>
  <a href="">
    <span class="badge blue mr-1">New</span>
  </a>
  <a href="">
    <span class="badge red mr-1">Bestseller</span>
  </a>
</div>

<p class="lead">
  <span class="mr-1">
    <del>₹<?php echo "{$row['pcost']}" ?></del>
  </span>
  <span class="text-success font-weight-bold">₹<?php $cost=$row['pcost']; $discount=$row['discount']; $discountpercentage=($discount/100); $disc=$discountpercentage*$cost; $finalcost=$cost-$disc; echo "$finalcost" ?></span>
</p>

<p>Delivery by <span class="font-weight-bolder"><?php date_default_timezone_set("Asia/Calcutta"); $days = $row['expecteddeliverdate']; $d=strtotime("+$days Days"); echo date("Y-m-d", $d);?></span></p>


<p class="lead font-weight-bold">Description</p>

<p><?php echo "{$row['pdesc']}" ?></p>
<p>Shipping Cost: <span class="font-weight-bolder"><?php echo "{$row['shippingcost']}" ?></span></p>

<p>No. of Days to Return Product: <span class="font-weight-bolder"><?php echo "{$row['returnpolicy']}" ?></span></p>
<!-- <form class="d-flex justify-content-left"> -->
    <!-- Default input -->
    <a class="btn btn-primary btn-md my-0 mt-4 p" href='../controller/addtocartcontroller.php?pid=<?php echo "{$productid}"?>'>Add to cart
        <i class="fas fa-shopping-cart ml-1"></i>
    </a>
    
<!-- </form> -->

</div>
  </div>
            </div>
  <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
 <!-- <script src="../js/Carousel.js"></script> 
  <script>
		$(function(){
			Carousel.init($("#carousel"));
			$("#carousel").init();
		});
	</script> <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>  -->
<?php }
 mysqli_close($db); ?>
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>