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
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../css/reg.css" rel="stylesheet" media="all">
    <script src="https://kit.fontawesome.com/cef3123337.js" crossorigin="anonymous"></script>
	
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<?php //include "header.php"; ?>
<?php include "sidebar.php"; ?>
<!-- <div class="content-inner"> -->
     
<div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Add Product Form</h2>
                </div>
                <div class="card-body">
                    <form action="../controller/addproductcontroller.php" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                            <div class="name">Product Name</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="productname">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Description</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="desc">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Product Image</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="file" name="photo[]" multiple>
                                </div>
                            </div>
                        </div>
                        <div class="form-row m-b-55">
                            <div class="name">Product Cost</div>
                            <div class="value">
                                <div class="row row-refine">
                                    <div class="col-9">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="cost">
                                            <label class="label--desc">Cost</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="discount">
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
                                    <input class="input--style-5" type="text" name="expecteddelivery">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Shipping Cost</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="shipping">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Type of product</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="selectedtype">
                                            <option disabled="disabled" selected="selected">Choose option</option>
                                            <option value="virtual">Virtual Product</option>
                                            <option value="physical">Physical Product</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">No. of Days to Return the product</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="return">
                                            <option disabled="disabled" selected="selected">Choose option</option>
                                            <option value="5">5 Days</option>
                                            <option value="10">10 Days</option>
                                            <option value="15">15 Days</option>
                                            <option value="30">20 Days</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Category of product</div>
                            <?php 


    $sql = "select catname from category_mst";
    $result = mysqli_query($db,$sql) or die("Bad query $sql");

    ?>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="category">
                                            <option disabled="disabled" selected="selected">Choose option</option>
                                            <?php 
        while($row = mysqli_fetch_assoc($result)){
        ?>
        <option value="<?php echo "{$row['catname']}" ?>"><?php echo "{$row['catname']}" ?></option>
        <?php } ?>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn--radius-2 btn-danger" type="submit" name="submit">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    <script src="../js/global.js"></script>
</body>
</html>