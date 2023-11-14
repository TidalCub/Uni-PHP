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
        
        <div class="checkout-payment col-6 col-lg-4 col-6 d-flex flex-column gap-2 justify-content-around">
          <?php if(date('H:i') < "19:00" && date("H:i") > "08:00"):?>
          <form>
            <div class="col-12"><span class="h5"> Chose Payment Method</span></div>
            <div class="checkout-payment-choice col-12">
              <div class="d-flex col-12 justify-content-around pt-2">
                <div class="form-check pay-radio d-flex justify-content-center">
                  <input class="form-check-input" type="radio" name="pay-type" id="google-pay" value="google-pay" required>
                  <label class="form-check-input pay-radio w-100" for="google-pay">
                    <img src="images/google-pay.svg" height="100%" class=""> 
                  </label>
                </div>
                <div class="form-check pay-radio d-flex justify-content-center">
                  <input class="form-check-input" type="radio" name="pay-type" id="card" value="card" required>
                  <label class="form-check-input pay-radio w-100" for="card">
                    <img src="images/card.svg" height="100%" class=""> 
                  </label>
                </div>
                <div class="form-check pay-radio d-flex justify-content-center">
                  <input class="form-check-input" type="radio" name="pay-type" id="paypal" value="paypal" required>
                  <label class="form-check-input pay-radio w-100" for="paypal">
                    <img src="images/paypal.svg" height="100%" class=""> 
                  </label>
                </div>
              </div>
              <p class="ps-2 text-muted">We do not accept amex</p>
            </div>
            <div class="col-12"><span class="h5">Order Details</span></div>
            <div class="checkout-payment-details col-12">
              <h4>For:</h4>
              <div class="col-12 display-4 text-center">Pickup</div>
              <hr />
              <h4>Pickup Time:</h4>
              <div class="from-group col-12 text-center">
                <p class="text-muted">Between now and 19:00</p>
                <input type="time" id="time" min="<?=date('H:i')?>" max="19:00" value="<?=date('H:i')?>" requiered class="h2" oninput="validateTime()"/>
                <div id="time-order-error" class="text-danger"></div>
              </div>
              <hr/>
              <h4>Order Total:</h4>
              <div class="display-4 col-12 text-center">
                <?php 
                echo "£". $basket->get_total();
                ?>
              </div>
              <hr />
              <div class="col-12 text-center">thank you for ordering with us, once you confirm payment, we will start making your order. please see here for F&Q and help. </div>
            </div>
            <div class="col-12"><span class="h5">Pay</span></div>
            <button class="btn btn-primary col-12" type="submit"><span class="display-5">Pay</span></button>
            </div>
          </form>
          <?php else :?>
            <div class="col-12 checkout-payment-details p-5 text-center">
            <div class="display-5 text-danger"><i class='fas fa-exclamation-triangle' ></i></div>
              <h1>We are currently Closed</h1>
              <p>We are unable to process payments or orders at this time</p>
              <hr />
              <p>Our opening hours are 8:00 - 19:00</p>
            </div>
          <?php endif ?> 
        </div>
      </div>
    </div>
</body>
<script>
function validateTime() {
    var currentTimeInput = document.getElementById('time').value;
    var currentTime = new Date();
    var selectedTime = new Date();
    var selectedTimeParts = currentTimeInput.split(':');

    selectedTime.setHours(selectedTimeParts[0]);
    selectedTime.setMinutes(selectedTimeParts[1]);

    var isPast = selectedTime < currentTime;
    var isPast19 = currentTimeInput > '19:00';

    var errorDiv = document.getElementById('time-order-error');

    if (isPast) {
        errorDiv.innerHTML = "The time can not be in the past";
    }else if(isPast19){
      errorDiv.innerHTML = "We will be closed by then.";
    } else {
        errorDiv.innerHTML = "";
    }
}
</script>
</html>
