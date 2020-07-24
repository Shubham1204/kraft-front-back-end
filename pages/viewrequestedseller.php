<?php 
include "../controller/config.php"; 
session_start();
if(isset($_SESSION["email"])){  
}
else{
    header( "location: notlogin.html");
}if($_SESSION['rolename']=="admin"){
    
}
else{
    header("location: notlogin.html");
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Requeested Seller
    </title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css"> -->
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<?php //include"header.php" ?>
<?php include "sidebar.php"; ?>
<!-- <div class="content-inner"> -->
     
   <h1>
   <?php

$sql = "select rsellerid,username,email,contact,address,city,state,pincode,pickup from register_seller_mst";
$result = mysqli_query($db,$sql) or die("Bad query $sql");
// echo "Successful";?>
<h1></h1>
	<table class='table table-bordered'>
			<thead class='thead-dark'>
				<tr>
					<th>Seller Name</th>
					<th>Seller Email</th>
                    <th>Seller Contact No.</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Pincode</th>
                    <th>Pickup Address</th>
                    <th></th>
				</tr>
			</thead>
			<tbody>
                <?php
while($row = mysqli_fetch_assoc($result)){
// echo "{$row['username']} {$row['uid']}";
// }
// if(mysqli_fetch_assoc($result)){
    ?>
    <tr>
    <td><?php echo "{$row['username']}" ?></td>
    <td><?php echo "{$row['email']}" ?></td>
    <td><?php echo "{$row['contact']}" ?></td>
    <td><?php echo "{$row['address']}" ?></td>
    <td><?php echo "{$row['city']}" ?></td>
    <td><?php echo "{$row['state']}" ?></td>
    <td><?php echo "{$row['pincode']}" ?></td>
    <td><?php echo "{$row['pickup']}" ?></td>
    <td><button class="btn btn-primary "><a class="text-secondary" href='../controller/addregisteredsellercontroller.php?sid=<?php echo "{$row['rsellerid']}" ?>'>Add</a></button></td>
    </tr>
    <!-- echo "{$row['userid']} {$row['email']} {$row['contact']} <br>"; -->
<!-- //    echo ' <input type="text" name="cllg" id="cllg" value='{$row['username']}'>'; -->
<!-- // } else{ -->
    <!-- // echo "cllg list empty"; -->
    <?php
}
?>
</tbody>
</table>
<?php 
// Close connection
mysqli_close($db);
?></h1>
</div>
</div>
</body>
</html>