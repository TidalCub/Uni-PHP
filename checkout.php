<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
      require "views/shared/_head.php" ;
      include 'processess/basket.php';
    ?>
</head>
<body>
    <?php require "views/shared/_header.php" ?>
    <div class="checkout-background">
      <div class="display-2">Checkout</div>
      <div class="d-flex justify-content-around w-100 gap-2  p-5 pt-0">
        <div class="checkout-sum col-6 col-lg-5 col-sm-6">
          <h1 class="ps-3">Order Summary</h1>
          <?php require "views/shared/_basket.php"?>
        </div>

        <div class="checkout-payment col-6 col-lg-4 col-6 d-flex flex-column gap-2 justify-content-around">
          <div class="col-12"><span class="numberCircle">1</span> <span class="h5"> Chose Payment Method</span></div>
          <div class="checkout-payment-choice col-12">
            <div class="ps-4 pe-4 w-100 d-flex justify-content-between">
              <img src="images/google-pay.svg" class="col-3"> 
              <img src="images/card.svg" class="col-2"> 
              <img src="images/paypal.svg" class="col-4"> 
            </div>
          </div>
          <div class="col-12"><span class="numberCircle">2</span><span class="h5"> Confirm Details</span></div>
          <div class="checkout-payment-details col-12 flex-grow-1 ps-3 pe-3">
            <span class="h4">Order For:</span><br>
            <div class="display-5 col-12 text-center">PickUp</div>
            <hr />
            <span class="h4">Order Time:</span><br>
            <div class="display-5 col-12 text-center">Now</div>
            <p class="col-12 text-center"><a href="">Change</a></p>
            <hr />
            <span class="h4">Order Total:</span><br>
            <div class="display-4 col-12 text-center">
              <?php 
              echo "£". $basket->get_total();
              ?>
            </div>
            <hr />
            <div class="col-12 text-center">thank you for ordering with us, once you confirm payment, we will start making your order. please see here for F&Q and help. </div>
          </div>
          <div class="col-12"><span class="numberCircle">3</span><span class="h5"> Pay</span></div>
          <a class="btn btn-primary" href="/"><h1>Pay</h1></a>
        </div>
      </div>
    </div>
</body>

</html>
