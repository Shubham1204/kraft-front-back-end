<?php

include "config.php"; 
session_start();
$productid = htmlspecialchars($_GET["pid"]);
$orderid = htmlspecialchars($_GET["oid"]);
$orderdate = htmlspecialchars($_GET["odate"]);

$orderstatusdetail = mysqli_real_escape_string($db, $_REQUEST['orderstatusdetail']);
// echo "$orderstatusdetail";
// $cancel = "cancel";
$sql = "UPDATE order_mst SET orderstatus='$orderstatusdetail' WHERE orderid=$orderid and orderdate='$orderdate' and pid=$productid";
$result = mysqli_query($db,$sql) or die("Bad query $sql");
if($result){
    header( "location: ../pages/viewrecievedorders.php");
    }  
     else{
        header( "location: ../pages/notlogin.html");
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
}

mysqli_close($db);
?>