<?php

include "config.php"; 
session_start();
$productid = htmlspecialchars($_GET["pid"]);
// $sql = "INSERT INTO user_cart_mapping(userid) VALUES ((select uid from user_mst where user_mst.email='{$_SESSION['email']}'))";
// $userdto = new userDTO();
// $rights = new array($rightDTO);
// $sql = "SELECT userid from user_mst where user_mst.email='{$email}'";
// $result = mysqli_query($db,$sql) or die("Bad query $sql");
// DELETE FROM `product_seller_cart_mapping` WHERE `product_seller_cart_mapping`.`MAPID` = 2
$sql1 = "DELETE FROM product_seller_cart_mapping WHERE product_seller_cart_mapping.productid=$productid";
$result1 = mysqli_query($db,$sql1) or die("Bad query $sql1");
// if($row = mysqli_fetch_assoc($result)){
    // if($result){
if($result1){
       
    header( "location: ../pages/cart.php");
    }
// }
  
     else{
        header( "location: ../pages/notlogin.html");
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
}

mysqli_close($db);
?>