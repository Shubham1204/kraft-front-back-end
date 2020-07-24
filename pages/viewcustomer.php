<?php 
include "../controller/config.php"; 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard
    </title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css"> -->
    <script src="https://kit.fontawesome.com/cef3123337.js" crossorigin="anonymous"></script>
	
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

// include "../controller/config.php"; 


$sql = "select username,email,contact from user_mst,user_role_mapping,role_mst where user_role_mapping.userid=user_mst.uid and user_role_mapping.roleid=role_mst.roleid and role_mst.rolename='customer'";
$result = mysqli_query($db,$sql) or die("Bad query $sql");
// echo "Successful";?>
<h1></h1>
<!-- <br> -->
	<table class='table table-bordered'>
			<thead class='thead-dark'>
				<tr>
					<th>Customer Name</th>
					<th>Customer Email</th>
					<th>Customer Contact No.</th>
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