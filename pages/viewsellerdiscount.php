<?php 
include "../controller/config.php"; 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/viewdiscount.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body style="background-color: #EEF5F9">
<?php include "sidebar.php"; ?>
<section id="labels">
  <div class="container-fluid">
	<div class="row">
    <?php $sql = "SELECT username,dname, percentage, maxamount, lastdate,coupon FROM discount_mst,seller_discount_mapping,user_mst where seller_discount_mapping.sellerid=user_mst.uid and discount_mst.did=seller_discount_mapping.discountid and  seller_discount_mapping.sellerid=(select uid from user_mst where email='{$_SESSION['email']}')";
$result = mysqli_query($db,$sql) or die("Bad query $sql");
$i=0;
while($row = mysqli_fetch_assoc($result)){?>
        <div class="col-sm-5 col-md-3 mb-4 mx-auto">
          <div class="dl">
            <div class="brand">
                <h2>
                    <?php echo"{$row['dname']}"; ?>
                </h2>
            </div>
            <?php 
            $color = array("alizarin","peter-river","emerald","amethyst");
            $randIndex = array_rand($color);
            ?>
            <div class="discount <?php echo $color[$randIndex]; ?>">
            <?php echo"{$row['percentage']}"; ?>%
                <div class="type">
                    off
                </div>
            </div>
            <div class="descr">
               <strong>Applies to Products by: <?php echo"{$row['username']}"; ?></strong>
                <p>Maximum Amount: ₹<?php echo"{$row['maxamount']}"; ?></p>
                <p class="expire" style="color: red">Expires: <?php echo"{$row['lastdate']}"; ?></p>
            </div>
            <div class="ends">
                <small>
                    * Conditions and restrictions apply.
                </small>
            </div>
            <div class="coupon midnight-blue">
                <a data-toggle="collapse" href="#code-<?php echo"{$i}" ?>" class="open-code">Get a code</a>
                <div id="code-<?php echo"{$i}" ?>" class="collapse code">
                <?php echo"{$row['coupon']}"; ?>
                </div>
            </div>
          </div>
        </div>
<?php
$i=$i+1;
} ?>
	</div>
	</div>
  </div>
</section>
</body>
</html>