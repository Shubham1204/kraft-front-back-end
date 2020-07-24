<?php 
include "../controller/config.php"; 
session_start();
$sum = mysqli_real_escape_string($db, $_REQUEST['sum']);
// $productid = array(mysqli_real_escape_string($db, $_REQUEST['productid']));
?>
<?php 
// session_start();
if(isset($_SESSION["email"])){  
}
else{
    header( "location: notlogin.html");
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Checkout</title>

  <!-- Font Awesome -->
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link href="../css/mdb1.min.css" rel="stylesheet">
  
</head>

<body>
<?php //include "header.php"; ?>
<?php include "sidebar.php"; ?>
<!-- <div class="content-inner"> -->
      
<main class="">
  <?php //echo"{$_SESSION['randomoid']}" ?>
    <div class="container wow fadeIn">
      <!-- Heading -->
      <h2 class="my-5 h2 text-center">Shipping</h2>
<form action="../controller/checkoutcontroller.php" method="post">
      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
        <div class="col-md-8 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card content-->
            <form class="card-body">

              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="col-md-12 mb-2">

                  <!--firstName-->
                  <div class="md-form ">
                    <input type="text" id="Name" name="custname" class="form-control">
                    <label for="Name" class="">Name</label>
                  </div>

                </div>
                <!--Grid column-->

               
                <!--Grid column-->

              </div>
              <!--Grid row-->

              <!--email-->
              <div class="md-form mb-5">
                <input type="text" id="email" class="form-control" placeholder="Email" disabled value="<?php echo"{$_SESSION['email']}" ?>">
                <!-- <label for="email" class="">Email (optional)</label> -->
              </div>

              <!--address-->
              <div class="md-form mb-5">
                <input type="text" id="address-1" name="address1" class="form-control" placeholder="Apartment or suite">
                <!-- <label for="address-2" class="">Address 2 (optional)</label> -->
              </div>
              <div class="md-form mb-5">
                <input type="text" id="address" name="address2" class="form-control" placeholder="Street or Locality">
                <!-- <label for="address" class="">Address</label> -->
              </div>

              <!--address-2-->

              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4">

                  <label for="country">Country</label>
                  <select class="custom-select d-block w-100" name="country" id="country" required>
                    <option value="">Choose...</option>
                    <option value="india">India</option>
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid country.
                  </div>

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4">

                  <label for="state">State</label>
                  <select class="custom-select d-block w-100" name="state" id="state" required>
                    <option value="">Choose...</option>
                    <option value="delhi">Delhi</option>
                  </select>
                  <div class="invalid-feedback">
                    Please provide a valid state.
                  </div>

                </div>

                <div class="col-lg-3 col-md-6 mb-4">
<label for="state">City</label>
<select class="custom-select d-block w-100" name="city" id="city" required>
  <option value="">Choose...</option>
  <option value="newdelhi">New Delhi</option>
</select>
<div class="invalid-feedback">
  Please provide a valid city.
</div>

</div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4">

                  <label for="zip">Zip Code</label>
                  <input type="text" class="form-control" name="pincode" id="zip" placeholder="Pincode" required>
                  <div class="invalid-feedback">
                    Zip code required.
                  </div>

                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->

              <hr>


              <div class="d-block my-3">
                <div class="custom-control custom-radio">
                  <input id="cod" name="paymentmethod" value="cod" type="radio" class="custom-control-input" checked required>
                  <label class="custom-control-label"  for="cod">Cash On Delivery</label>
                </div>
                <!-- <div class="custom-control custom-radio">
                  <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="debit">Debit card</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="paypal">Paypal</label>
                </div> -->
              </div>
              <!-- <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="cc-name">Name on card</label>
                  <input type="text" class="form-control" id="cc-name" placeholder="" required>
                  <small class="text-muted">Full name as displayed on card</small>
                  <div class="invalid-feedback">
                    Name on card is required
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="cc-number">Credit card number</label>
                  <input type="text" class="form-control" id="cc-number" placeholder="" required>
                  <div class="invalid-feedback">
                    Credit card number is required
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 mb-3">
                  <label for="cc-expiration">Expiration</label>
                  <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                  <div class="invalid-feedback">
                    Expiration date required
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="cc-expiration">CVV</label>
                  <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                  <div class="invalid-feedback">
                    Security code required
                  </div>
                </div>
              </div> -->
              <hr>
              <div class="d-block my-3">
                <div class="custom-control custom-radio">
                  <input id="home" name="addresstype" value="home" type="radio" class="custom-control-input" checked required>
                  <label class="custom-control-label" for="home">HOME</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="work" name="addresstype" value="work" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="work">WORK</label>
                </div>
              </div>
              <hr class="mb-4">
              <button class="btn btn-primary btn-lg btn-block" type="submit">Order Now</button>

            </form>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-4 mb-4">

          <!-- Heading -->
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <!-- <span class="badge badge-secondary badge-pill">3</span> -->
          </h4>

          <!-- Cart -->
          <ul class="list-group mb-3 z-depth-1">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Price</h6>
                
              </div>
              <span class="text-muted">₹<?php echo"{$sum}" ?></span>
            </li>
        
            <!-- <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>EXAMPLECODE</small>
              </div>
              <span class="text-success">-$5</span>
            </li> -->
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Total (INR)</h6>
                <!-- <small>EXAMPLECODE</small> -->
              </div>
              <span class="text-success">₹<?php echo"{$sum}" ?></span>
            </li>
           
          </ul>
          <!-- Cart -->

          <!-- Promo code -->
          <!-- <form class="card p-2">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Promo code" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-secondary btn-md waves-effect m-0" type="button">Apply</button>
              </div>
            </div>
          </form> -->
          <!-- Promo code -->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->
</form>
    </div>
  </main>
</div>
</div>
<!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>
  <?php mysqli_close($db);
?>
</body>

</html>