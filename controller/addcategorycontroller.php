<?php

include "config.php"; 
session_start();

// include "../dto/userDTO.php";
// include "../dto/rightDTO.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
// Escape user inputs for security
$catname = mysqli_real_escape_string($db, $_REQUEST['catname']);
$desc = mysqli_real_escape_string($db, $_REQUEST['desc']);

if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
    $allowed = array("jpg" => "image/jpg","JPG" => "image/JPG", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    $filename = $_FILES["photo"]["name"];
    $filetype = $_FILES["photo"]["type"];
    $filesize = $_FILES["photo"]["size"];

    // Verify file extension
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

    // Verify file size - 5MB maximum
    $maxsize = 5 * 1024 * 1024;
    if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
    // Verify MYME type of the file
    if(in_array($filetype, $allowed)){
        if(file_exists("../uploads/category/" . $catname.".".$ext)){
            echo $filename . " is already exists.";
        } else{
            
            $filename = $_FILES['photo']['name'];
            
            // Upload file
            // move_uploaded_file($_FILES['photo']['tmp_name'][$i],'uploads/'.$filename);
            move_uploaded_file($_FILES["photo"]["tmp_name"], "../uploads/category/" .$catname.".".$ext);
            $imagepath = "../uploads/category/".$catname.".".$ext;
            $sql = "INSERT INTO category_mst(catname,description,catimagepath) VALUES ('{$catname}','{$desc}','{$imagepath}')";
            $result = mysqli_query($db,$sql) or die("Bad query $sql");
           if($result){
                // if($result1){
                    // if($result2){
                        header( "location: ../pages/requestregistered.html");
                // }
            // }
        }
                 else{
                    echo 'alert("Unable to add Category try Again!!")';
                    header( "location: ../pages/addcategory.php");
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
            }
            
        }
        // Check whether file exists before uploading it
        echo "Your file was uploaded successfully.";
    } else{
        echo "Error: There was a problem uploading your file. Please try again."; 
    }
} else{
    echo "Error: " . $_FILES["photo"]["error"];
} 
}
mysqli_close($db);
?>