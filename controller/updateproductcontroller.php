<?php

include "config.php"; 
session_start();
// $productid = htmlspecialchars($_POST["pid"]);
// include "../dto/userDTO.php";
// include "../dto/rightDTO.php";
// if($_SERVER["REQUEST_METHOD"] == "POST"){
// Escape user inputs for security
$productid = mysqli_real_escape_string($db, $_REQUEST['productid']);
$productname = mysqli_real_escape_string($db, $_REQUEST['productname']);
$desc = mysqli_real_escape_string($db, $_REQUEST['desc']);
$cost = mysqli_real_escape_string($db, $_REQUEST['cost']);
$discount = mysqli_real_escape_string($db, $_REQUEST['discount']);
$expecteddelivery = mysqli_real_escape_string($db, $_REQUEST['expecteddelivery']);
// $return = mysqli_real_escape_string($db, $_REQUEST['return']);
$shipping = mysqli_real_escape_string($db, $_REQUEST['shipping']);
// $selectedtype = mysqli_real_escape_string($db, $_REQUEST['selectedtype']);
// $category = mysqli_real_escape_string($db, $_REQUEST['category']);
// $uploadimage = mysqli_real_escape_string($db, $_REQUEST['uploadimage[]']);

    $sql = "UPDATE product_mst SET pname='$productname',pdesc='$desc',pcost='$cost',expecteddeliverdate='$expecteddelivery',discount='$discount',shippingcost='$shipping' WHERE product_mst.pid=$productid";
    $result = mysqli_query($db,$sql) or die("Bad query $sql");
    if($result){
        header( "location: ../pages/requestregistered.html");
    }else{
        echo"There is some problem!!";
    }
mysqli_close($db);
?>