<?php

include "config.php"; 
// include "../dto/userDTO.php";
// include "../dto/rightDTO.php";

        session_start();

// Escape user inputs for security
$coupon = mysqli_real_escape_string($db, $_REQUEST['coupon']);
$dname = mysqli_real_escape_string($db, $_REQUEST['dname']);
$maxamount = mysqli_real_escape_string($db, $_REQUEST['maxamount']);
$percentage = mysqli_real_escape_string($db, $_REQUEST['percentage']);
$lastdate = mysqli_real_escape_string($db, $_REQUEST['lastdate']);
// $password = mysqli_real_escape_string($db, $_REQUEST['password']);
//  echo "email: {$email}";
// Attempt insert query execution
// $sql = "SELECT user_mst.email, role_mst.rolename,right_mst.rightname,right_mst.link from user_mst,role_mst,user_role_mapping,right_mst,role_right_mapping where user_mst.uid=user_role_mapping.USERID and user_role_mapping.ROLEID=role_mst.roleid and right_mst.rightid=role_right_mapping.rightid and user_mst.email='{$email}' and user_mst.password='{$password}'";
$sql = "INSERT INTO discount_mst(dname,coupon,percentage,maxamount,lastdate) VALUES ('{$dname}','{$coupon}','{$percentage}','{$maxamount}','{$lastdate}')";
// $userdto = new userDTO();
// $rights = new array($rightDTO);
// $sql = "SELECT userid from user_mst where user_mst.email='{$email}'";
$result = mysqli_query($db,$sql) or die("Bad query $sql");
$sql1 = "INSERT INTO seller_discount_mapping(sellerid, discountid) VALUES ((SELECT uid FROM user_mst WHERE user_mst.email='{$_SESSION["email"]}'),(SELECT did FROM discount_mst WHERE discount_mst.coupon='{$coupon}'))";
$result1 = mysqli_query($db,$sql1) or die("Bad query $sql1");
// if($row = mysqli_fetch_assoc($result)){
    if($result){
if($result1){
        // $userdto->setEmail($row['email']);
        // $userdto->setRolename($row['rolename']);
        // $rights = new array($rightDTO);
        // $userdto->setRights($rights);
        

        // session_start();
        // echo "Username : {$row['userid']}";
       
        // $_SESSION["email"] = $row['email'];
        // $_SESSION["rolename"] = $row['rolename'];

        // $_SESSION["password"] = $row['password'];
    header( "location: ../pages/requestregistered.html");
    // exit;
    }
}
    // else{
        
        // }
        // echo "Record successfully  {$row['username']}";
    // }
     else{
        header( "location: ../pages/notlogin.html");
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
}
// $right = new rightDTO($row['rightname'],$row['link']);
// $rights_add($right);
//   rights.add(right);
// $right = new rightsDTO()
// $rights.add(right);
// }
// echo " userid:  " .$userdto->getEmail()." rolename: ".$userdto->getRolename();
// Close connection
mysqli_close($db);
?>