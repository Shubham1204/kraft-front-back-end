<?php 

include "config.php";
$sellerid = htmlspecialchars($_GET["sid"]);

$sql = "INSERT INTO user_mst(username, email, contact, password) VALUES ((select username from register_seller_mst where rsellerid=$sellerid),(select email from register_seller_mst where rsellerid=$sellerid),(select contact from register_seller_mst where rsellerid=$sellerid),(select password from register_seller_mst where rsellerid=$sellerid))";
$result = mysqli_query($db,$sql) or die("Bad query $sql");

$sql1 = "INSERT INTO user_role_mapping(userid, roleid) VALUES ((SELECT uid FROM user_mst WHERE user_mst.email=(select email from register_seller_mst where rsellerid=$sellerid)),(SELECT roleid FROM role_mst WHERE role_mst.rolename='seller'))";
$result1 = mysqli_query($db,$sql1) or die("Bad query $sql1");

$sql2 = "INSERT INTO seller_address_mst(sellerid,address,city,state,pincode,pickup) VALUES ((SELECT uid FROM user_mst WHERE user_mst.email=(select email from register_seller_mst where rsellerid=$sellerid)),(select address from register_seller_mst where rsellerid=$sellerid),(select city from register_seller_mst where rsellerid=$sellerid),(select state from register_seller_mst where rsellerid=$sellerid),(select pincode from register_seller_mst where rsellerid=$sellerid),(select pickup from register_seller_mst where rsellerid=$sellerid))";
$result2 = mysqli_query($db,$sql2) or die("Bad query $sql2");

$sql4 = "INSERT INTO user_cart_mapping(userid) VALUES ((select uid from user_mst where user_mst.email=(select email from register_seller_mst where rsellerid=$sellerid)))";
$result4 = mysqli_query($db,$sql4) or die("Bad query $sql4");

$sql3 = "DELETE FROM register_seller_mst WHERE register_seller_mst.rsellerid = $sellerid;";
$result3 = mysqli_query($db,$sql3) or die("Bad query $sql3");



if($result){
    if($result1){
if($result2){
    if($result4){
    if($result3){
        header( "location: ../pages/requestregistered.html");
        echo "alert('seller request registered')";
    }    }
}
        }
    }
    
         else{
            header( "location: ../pages/registerseller.php");
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
    }
    mysqli_close($db);
    ?>
?>