<?php

include "config.php"; 
session_start();
if(isset($_SESSION["email"])){  
}
else{
    header( "location: ../pages/notlogin.html");
}
$productid = htmlspecialchars($_GET["pid"]);
// $sql = "INSERT INTO user_cart_mapping(userid) VALUES ((select uid from user_mst where user_mst.email='{$_SESSION['email']}'))";
// $userdto = new userDTO();
// $rights = new array($rightDTO);
// $sql = "SELECT userid from user_mst where user_mst.email='{$email}'";
// $result = mysqli_query($db,$sql) or die("Bad query $sql");
$sql1 = "INSERT INTO product_seller_cart_mapping(productid,sellerid,sellername, cartid) VALUES ((SELECT pid FROM product_mst WHERE product_mst.pid=$productid),(SELECT sellerid FROM seller_product_mapping WHERE seller_product_mapping.productid=$productid),(SELECT username FROM user_mst WHERE user_mst.uid=(SELECT sellerid FROM seller_product_mapping WHERE seller_product_mapping.productid=$productid)),(SELECT cartid FROM user_cart_mapping WHERE userid=(select uid from user_mst where user_mst.email='{$_SESSION['email']}')))";
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