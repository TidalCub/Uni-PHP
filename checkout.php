<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
      require "views/shared/_head.php" ;
      include 'processess/basket.php';
      require "user/user_obj.php";

      $user = new user();
      $email = $user->get_user_details()->fetch_assoc()["email"];
      $name = $user->get_user_details()->fetch_assoc()["first_name"];
    ?>
</head>
<body >
    <?php require "views/shared/_header.php" ?>
    <div class="checkout-background ">
      <div class="display-2">Checkout</div>
      
      <div class="d-flex flex-wrap justify-content-around col-12 gap-2 p-1">
        <div class="checkout-sum col-12 col-lg-5 col-md-5 mb-3 pb-3 ">
          <h1 class="ps-3">Order Summary</h1>
          <?php require "views/shared/_basket.php"?>
        </div>
        <div class="col-12 col-md-5 col-lg-5">
          <?php require_once "forms/_payment.php"?>
        </div>
        
      </div>
    </div>
</body>
</html>
