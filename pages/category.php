<?php 
include "../controller/config.php"; 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css"> -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <!-- animate CSS -->
    <link rel="stylesheet" href="../css/category/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="../css/category/owl.carousel.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="../css/category/all.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="../css/category/flaticon.css">
    <link rel="stylesheet" href="../css/category/themify-icons.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="../css/category/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="../css/category/slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="../css/category/style.css">
    <title>Document</title>
</head>
<body style="background-color: #EEF5F9">
<?php //include "header.php"; ?>
<?php include "sidebar.php"; ?>
<!-- <div class="content-inner"> -->
    
<section class="feature_part mt-2 ">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section_tittle text-center">
                        <h2>Featured Category</h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
            <?php 
                $sql = "select catid,catname,description,catimagepath from category_mst";
                $result = mysqli_query($db,$sql) or die("Bad query $sql");
                while($row = mysqli_fetch_assoc($result)){  ?>  
            <div class="col-lg-6 col-sm-6">
                    <div class="single_feature_post_text">
                        <p>Premium Quality</p>
                        <h3 class="text-uppercase"><?php echo"{$row['catname']}" ?></h3>
                        <a href="categoryproduct.php?catid=<?php echo"{$row['catid']}" ?>" class="feature_btn">EXPLORE NOW <i class="fas fa-play"></i></a>
                        <img style="height: 100%;width: 60%;" src="<?php echo"{$row['catimagepath']}" ?>" alt="">
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
                </div>
</div>
</body>
</html>