<?php

include "config.php"; 
session_start();

// Escape user inputs for security
$custname = mysqli_real_escape_string($db, $_REQUEST['custname']);
$address1 = mysqli_real_escape_string($db, $_REQUEST['address1']);
$address2 = mysqli_real_escape_string($db, $_REQUEST['address2']);
$country = mysqli_real_escape_string($db, $_REQUEST['country']);
$state = mysqli_real_escape_string($db, $_REQUEST['state']);
$city = mysqli_real_escape_string($db, $_REQUEST['city']);
$pincode = mysqli_real_escape_string($db, $_REQUEST['pincode']);
$paymentmethod = mysqli_real_escape_string($db, $_REQUEST['paymentmethod']);
$addresstype = mysqli_real_escape_string($db, $_REQUEST['addresstype']);

// echo "{$custname} {$address1} {$address2} {$country} {$state} {$city} {$pincode} {$paymentmethod} {$addresstype}";

date_default_timezone_set("Asia/Calcutta");
 $date=date("d-m-Y");
 $time=date("h:i:sa");
//  $i=0;


$sql0 = "select uid from user_mst where user_mst.email='{$_SESSION['email']}'";
$result0 = mysqli_query($db,$sql0) or die("Bad query $sql0");
while($row = mysqli_fetch_assoc($result0)){
    $uiddatetime = date("{$row['uid']}Ymdhis");
}

$sql = "INSERT INTO customer_address_mst(custid,orderid,custname, custemail, address, address1, city, state, pincode, addresstype) VALUES ((select uid from user_mst where user_mst.email='{$_SESSION['email']}'),'$uiddatetime','$custname','{$_SESSION['email']}','$address1','$address2','$city','$state','$pincode','$addresstype')";
$result = mysqli_query($db,$sql) or die("Bad query $sql");

// $sql1 = "INSERT INTO payment_mst(pmethod, transactionid, date, time) VALUES ('$paymentmethod',$uiddatetime.$i,'$date','$time')";
// $result1 = mysqli_query($db,$sql1) or die("Bad query $sql1");
$sql2 = "SELECT pid,expectedate, totalamount, totalshipping FROM dummy_order_mst WHERE random='{$_SESSION['randomoid']}'";
$result2 = mysqli_query($db,$sql2) or die("Bad query $sql2");

while($row1 = mysqli_fetch_assoc($result2)){

    $sql3 = "INSERT INTO order_mst(orderid,custid, orderdate,pid, expecteddate, amount, shippingcost,paymentmethod,transactionid,orderstatus,time) VALUES ($uiddatetime,(select uid from user_mst where user_mst.email='{$_SESSION['email']}'),'$date','{$row1['pid']}','{$row1['expectedate']}','{$row1['totalamount']}','{$row1['totalshipping']}','$paymentmethod','$uiddatetime','processed','$time')";

    $result3 = mysqli_query($db,$sql3) or die("Bad query $sql3");

// if($result3){
    
    // $sql4 = "INSERT INTO order_payment_mapping(ORDERID, PAYMENTID) VALUES ((select oid from order_mst where order_mst.oid=$uiddatetime.$i and order_mst.orderdate={$date}),(select paymentid from payment_mst where transactionid=$uiddatetime.$i and date={$date} and time={$time}))";
    // $result4 = mysqli_query($db,$sql4) or die("Bad query $sql4");
    
    // if($result4){
    
        // $sql5 = "INSERT INTO customer_order_mapping(CUSTID, ORDERID) VALUES ((select uid from user_mst where user_mst.email='{$_SESSION['email']}'),(select oid from order_mst where order_mst.oid=$uiddatetime.$i and order_mst.orderdate={$date}))";
        // $result5 = mysqli_query($db,$sql5) or die("Bad query $sql5");
        // if($result5){
            // $sql5 ="select oid from order_mst where order_mst.oid=$uiddatetime and order_mst.orderdate={$date}";
            // $result5 = mysqli_query($db,$sql5) or die("Bad query $sql5");
            // while($rows = mysqli_fetch_assoc($result5)){

            // $sql6 = "INSERT INTO product_order_mapping(PRODUCTID, ORDERID) VALUES ({$row['pid']},{$rows['oid']})";
            // $result6 = mysqli_query($db,$sql6) or die("Bad query $sql6");
            // }
            // if($result6){
            //     $sql7 = "INSERT INTO seller_order_mapping(SELLERID, ORDERID) VALUES ()";
            //     $result7 = mysqli_query($db,$sql7) or die("Bad query $sql7");
            // }
        // }
    // }
// }
// $i=$i+1;

}
// $sql5 = "SELECT pid FROM dummy_order_mst WHERE random='{$_SESSION['randomoid']}'";
// $result5 = mysqli_query($db,$sql5) or die("Bad query $sql5");
// while($row2 = mysqli_fetch_assoc($result5)){
// $sql6="DELETE FROM dummy_order_mst WHERE random='{$_SESSION['randomoid']}'";
    
// $result6 = mysqli_query($db,$sql6) or die("Bad query $sql6");
// }
// $sql1 = "INSERT INTO user_role_mapping(userid, roleid) VALUES ((SELECT uid FROM user_mst WHERE user_mst.email='{$email}'),(SELECT roleid FROM role_mst WHERE role_mst.rolename='customer'))";

// $sql2 = "INSERT INTO user_cart_mapping(userid) VALUES ((select uid from user_mst where user_mst.email='{$email}'))";

    if($result){
// if($result1){
//     if($result2){
    header( "location: ../pages/ordersuccessful.php");

//     }
// }
}

     else{
        header( "location: ../pages/notlogin.html");
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
}

mysqli_close($db);
?>