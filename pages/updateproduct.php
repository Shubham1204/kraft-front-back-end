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
    header("location: notseller.html");
}
$productid = htmlspecialchars($_GET["pid"]);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link href="../css/reg.css" rel="stylesheet" media="all">
    <script src="https://kit.fontawesome.com/cef3123337.js" crossorigin="anonymous"></script>
	
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<?php //include "header.php"; ?>
<?php include "sidebar.php"; ?>
<!-- <div class="content-inner"> -->
     <?php  $sql = "select pname,pdesc,pcost,expecteddeliverdate,discount,shippingcost,ptype,returnpolicy from product_mst where product_mst.pid=$productid";
                            $result = mysqli_query($db,$sql) or die("Bad query $sql");
while($row = mysqli_fetch_assoc($result)){ ?>
<div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Update Product Form</h2>
                </div>
                <div class="card-body">
                    <form action="../controller/updateproductcontroller.php?pid=<?php echo"$productid" ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="productid" value="<?php echo"$productid"?>">
                    <div class="form-row">
                            <div class="h2">SORRY you can't update images,product type, retutn policy</div>
                    </div>
                    <div class="form-row">
                            <div class="name">Product Name</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="productname" value="<?php echo "{$row['pname']}" ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Description</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="desc" value="<?php echo "{$row['pdesc']}" ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-row m-b-55">
                            <div class="name">Product Cost</div>
                            <div class="value">
                                <div class="row row-refine">
                                    <div class="col-9">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="cost" value="<?php echo "{$row['pcost']}" ?>">
                                            <label class="label--desc">Cost</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="discount" value="<?php echo "{$row['discount']}" ?>">
                                            <label class="label--desc">Discount %</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Expected Delivery in Number of Days</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="expecteddelivery" value="<?php echo "{$row['expecteddeliverdate']}" ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Shipping Cost</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="shipping" value="<?php echo "{$row['shippingcost']}" ?>">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn--radius-2 btn-danger" type="submit" name="submit">Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <?php } ?>
</div>
        </div>
    <script src="../js/global.js"></script>
</body>
</html>