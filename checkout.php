<!DOCTYPE html>
<html lang="en" class="overflow-hidden">
<head>
    <?php 
      require "views/shared/_head.php" ;
      include 'processess/basket.php';
    ?>
</head>
<body >
    <?php require "views/shared/_header.php" ?>
    <div class="checkout-background ">
      <div class="display-2">Checkout</div>
      <div class="d-flex justify-content-around w-100 gap-2  p-5 pt-0">
        <div class="checkout-sum col-6 col-lg-5 col-sm-6">
          <h1 class="ps-3">Order Summary</h1>
          <?php require "views/shared/_basket.php"?>
        </div>
        <?php require_once "forms/_payment.php"?>
      </div>
    </div>
</body>
</html>
