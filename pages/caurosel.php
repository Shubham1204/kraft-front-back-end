<?php
//index.php
function make_query()
{
  include "../controller/config.php"; 
  // $connect = mysqli_connect("localhost", "root", "", "kraft_work");
  $productid = "72";
 $sql = "select imagepath from product_image_mst where productid={$productid}";
//  $result = mysqli_query($db, $query);
 $result = mysqli_query($db,$sql) or die("Bad query $sql");
 return $result;
}

function make_slide_indicators()
{
  // $connect = mysqli_connect("localhost", "root", "", "kraft_work");
  // include "../controller/config.php"; 
 $output = ''; 
 $count = 0;
 $result = make_query();
 while($row = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"></li>
   ';
  }
  else
  {
   $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'"></li>
   ';
  }
  $count = $count + 1;
 }
 return $output;
}

function make_slides()
{
  // $connect = mysqli_connect("localhost", "root", "", "kraft_work");
  // include "../controller/config.php"; 
 $output = '';
 $count = 0;
 $result = make_query();
 while($row = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '<div class="item active">';
  }
  else
  {
   $output .= '<div class="item">';
  }
  $output .= '
   <img src="'.$row["imagepath"].'" alt="'.$row["imagepath"].'"  style="height: 400px; width:100%;" />
   <div class="carousel-caption">
    <h3>'.$row["imagepath"].'</h3>
   </div>
  </div>
  ';
  $count = $count + 1;
 }
 return $output;
}

?>
<!DOCTYPE html>
<html>
 <head>
  <title>How to Make Dynamic Bootstrap Carousel with PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h2 align="center">How to Make Dynamic Bootstrap Carousel with PHP</h2>
   <br />
   <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel"  style="height: 400px">
    <ol class="carousel-indicators">
    <?php echo make_slide_indicators(); ?>
    </ol>

    <div class="carousel-inner">
     <?php echo make_slides(); ?>
    </div>
    <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
     <span class="glyphicon glyphicon-chevron-left"></span>
     <span class="sr-only">Previous</span>
    </a>

    <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
     <span class="glyphicon glyphicon-chevron-right"></span>
     <span class="sr-only">Next</span>
    </a>

   </div>
  </div>
 </body>
</html>