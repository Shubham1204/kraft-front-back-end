<?php

include "config.php"; 
session_start();

// include "../dto/userDTO.php";
// include "../dto/rightDTO.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
// Escape user inputs for security
$productname = mysqli_real_escape_string($db, $_REQUEST['productname']);
$desc = mysqli_real_escape_string($db, $_REQUEST['desc']);
$cost = mysqli_real_escape_string($db, $_REQUEST['cost']);
$discount = mysqli_real_escape_string($db, $_REQUEST['discount']);
$expecteddelivery = mysqli_real_escape_string($db, $_REQUEST['expecteddelivery']);
$return = mysqli_real_escape_string($db, $_REQUEST['return']);
$shipping = mysqli_real_escape_string($db, $_REQUEST['shipping']);
$selectedtype = mysqli_real_escape_string($db, $_REQUEST['selectedtype']);
$category = mysqli_real_escape_string($db, $_REQUEST['category']);
// $uploadimage = mysqli_real_escape_string($db, $_REQUEST['uploadimage[]']);

// $countfiles = count($_FILES['photo']['name']);
// for($i=0;$i<$countfiles;$i++){
// if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){

    $sql = "INSERT INTO product_mst(pname,pdesc,pcost,expecteddeliverdate,discount,shippingcost,ptype,returnpolicy) VALUES ('{$productname}','{$desc}','{$cost}','{$expecteddelivery}','{$discount}','{$shipping}','{$selectedtype}','{$return}')";
    $result = mysqli_query($db,$sql) or die("Bad query $sql");
    

    if( isset($_FILES['photo']['name'])) {
        $total_files = count($_FILES['photo']['name']);
    
    for($key = 0; $key < $total_files; $key++) {
    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    $filename = $_FILES["photo"]["name"][$key];
    $filetype = $_FILES["photo"]["type"][$key];
    $filesize = $_FILES["photo"]["size"][$key];

    // Verify file extension
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

    // Verify file size
    $maxsize = 5 * 1024 * 1024*1024;
    if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
    // Verify MYME type of the file
    if(in_array($filetype, $allowed)){
        if(file_exists("../uploads/products/" . $productname.".".$ext)){
            echo $filename . " is already exists.";
        } else{
            
            // $filename = $_FILES['photo']['name'];
            $original_filename = $_FILES['photo']['name'][$key];
        $target ="../uploads/products/" .$productname."_".$key.".".$ext;
        $imagepath = $target;
        $tmp  = $_FILES['photo']['tmp_name'][$key];
        move_uploaded_file($tmp, $target);
        $sql0="INSERT INTO product_image_mst(PRODUCTID, imagepath) VALUES ((SELECT pid FROM product_mst WHERE product_mst.pname='{$productname}'),'{$imagepath}')";
        $result0 = mysqli_query($db,$sql0) or die("Bad query $sql0");
      
        }
    }
}
    }
    
     $sql1 = "INSERT INTO product_category_mapping(PRODUCTID, CATEGORYID) VALUES ((SELECT pid FROM product_mst WHERE product_mst.pname='{$productname}'),(SELECT catid FROM category_mst WHERE category_mst.catname='{$category}'))";
            $result1 = mysqli_query($db,$sql1) or die("Bad Query $sql1");
            $sql2 = "INSERT INTO seller_product_mapping(SELLERID,PRODUCTID) VALUES ((SELECT uid FROM user_mst WHERE user_mst.email='{$_SESSION['email']}'),(SELECT pid FROM product_mst WHERE product_mst.pname='{$productname}'))";
            $result2 = mysqli_query($db,$sql2) or die("Bad Query $sql2");
            if($result){
                if($result1){
                    if($result2){
                        header( "location: ../pages/requestregistered.html");
                }
            }
        }
                 else{
                    echo 'alert("Unable to add Product try Again!!")';
                    header( "location: ../pages/addproduct.php");
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
            }
            
        
        // Check whether file exists before uploading it
        echo "Your file was uploaded successfully.";
    } else{
        echo "Error: There was a problem uploading your file. Please try again."; 
    }








//////////////////////////////////

// $countfiles = count($_REQUEST['uploadimage']);
// echo "{$countfiles} <br>";
// for($i=0;$i<$countfiles;$i++){
    // $filetemp = $_REQUEST['uploadimage'][$i];
    // echo "{$_REQUEST['uploadimage'][$i]} {$filetemp} <br>";
    // $without_extension = substr($_REQUEST['uploadimage'][$i], 0, strrpos($_REQUEST['uploadimage'][$i], "."));
    // $ext = pathinfo($_REQUEST['uploadimage'][$i], PATHINFO_EXTENSION);
    // $filename = $_FILES['uploadimage']['name'][$i];
    // $destinationfile = 'uploads/'.$productname."_{$i}.".$ext;
    // echo "{$_FILES["uploadimage"][$i]}";
    // move_uploaded_file($_FILES["uploadimage"]["tmp_name"][$i],$destinationfile);
    // echo "{$without_extension} {$ext} {$destinationfile} <br>";
// }

/////////////////////////////////////////////////////////

// echo "{$productname} {$uploadimage} {$without_extension} {$ext} {$destinationfile}";
mysqli_close($db);
?>