<?php

include "config.php"; 
// include "../dto/userDTO.php";
// include "../dto/rightDTO.php";

// Escape user inputs for security
$username = mysqli_real_escape_string($db, $_REQUEST['username']);
$email = mysqli_real_escape_string($db, $_REQUEST['email']);
$contact = mysqli_real_escape_string($db, $_REQUEST['contact']);
$password = mysqli_real_escape_string($db, $_REQUEST['password']);
$address = mysqli_real_escape_string($db, $_REQUEST['address']);
$city = mysqli_real_escape_string($db, $_REQUEST['city']);
$state = mysqli_real_escape_string($db, $_REQUEST['state']);
$pincode = mysqli_real_escape_string($db, $_REQUEST['pincode']);
$pickup = mysqli_real_escape_string($db, $_REQUEST['pickup']);
// $password = mysqli_real_escape_string($db, $_REQUEST['password']);
//  echo "email: {$email}";
// Attempt insert query execution
// $sql = "SELECT user_mst.email, role_mst.rolename,right_mst.rightname,right_mst.link from user_mst,role_mst,user_role_mapping,right_mst,role_right_mapping where user_mst.uid=user_role_mapping.USERID and user_role_mapping.ROLEID=role_mst.roleid and right_mst.rightid=role_right_mapping.rightid and user_mst.email='{$email}' and user_mst.password='{$password}'";
$sql = "INSERT INTO register_seller_mst(username,email,password,contact,address,city,state, pincode,pickup) VALUES ('{$username}','{$email}','{$password}','{$contact}','{$address}','{$city}','{$state}','{$pincode}','{$pickup}')";
// $userdto = new userDTO();
// $rights = new array($rightDTO);
// $sql = "SELECT userid from user_mst where user_mst.email='{$email}'";
$result = mysqli_query($db,$sql) or die("Bad query $sql");
// $sql1 = "INSERT INTO user_role_mapping(userid, roleid) VALUES ((SELECT uid FROM user_mst WHERE user_mst.email='{$email}'),(SELECT roleid FROM role_mst WHERE role_mst.rolename='customer'))";
// $result1 = mysqli_query($db,$sql1) or die("Bad query $sql1");
// if($row = mysqli_fetch_assoc($result)){
    if($result){
// if($result1){
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
        echo "alert('seller request registered')";
    // exit;
    // }
}
    // else{
        
        // }
        // echo "Record successfully  {$row['username']}";
    // }
     else{
        header( "location: ../pages/registerseller.php");
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