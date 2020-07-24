<?php 
// include "../controller/config.php"; 
// session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kraft World</title>
    <link href="../navbar/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container-fluid">
        <a class="navbar-brand display-1" href="../index.html">Kraft World</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
<ul class="navbar-nav ml-auto text-right">
            <li class="nav-item active">
              <a class="nav-link" href="main.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
 <?php            if(isset($_SESSION["email"])){  ?>
  <li class="nav-item">
    <a class="nav-link" href="logout.php">LogOut</a>
  </li>
  <?php
 $sql = "select username from user_mst where user_mst.email='{$_SESSION['email']}'";
                           $result = mysqli_query($db,$sql) or die("Bad query $sql");
 while($row = mysqli_fetch_assoc($result)){
?>
            <li class="nav-item">
              <a class="nav-link" href="viewprofile.php">Hi, <?php echo "{$row['username']}" ?></a>
            </li>
            <?php
}
 }   else{ ?>
  <li class="nav-item">
    <a class="nav-link" href="login.php">Sign In</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="register.php">Register</a>
  </li>
  <?php } ?> 
    <li class="nav-item">
      <a class="nav-link" href="cart.php">Cart</a>
    </li>
          </ul>
        </div>
      </div>
    </nav>
    <script src="../navbar/jquery/jquery.slim.min.js"></script>
    <script src="../navbar/bootstrap/js/bootstrap.bundle.min.js"></script>
<?php 
//mysqli_close($db);
?>  
</body>
</html>
