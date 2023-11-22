<!-- Payment form, this is a form used to process payment. A form is used for this to allow payment options, times and other options to the user when 
checking out. Forms are placed outside of the html where they will be used to isolate
them and make maintaining and debugging easier. The form is submitted to its self by using  echo htmlspecialchars($_SERVER["PHP_SELF"]); -->
<?php require_once "forms/action/payment_action.php" //This is required to so the forms action is in the same file so the form and submit to itself?>

<div class="checkout-payment col-6 col-lg-4 col-6 d-flex flex-column gap-2 justify-content-around">
  <!-- This is a check to see if the current time is between 8am and 7pm, if its not, do not let the user checkout -->
  <?php if(date('H:i') < "19:00" && date("H:i") > "08:00"):?> 

  <form class="form" id="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
        <!-- This is a time input that will only allow the user to select a time between now and 19:00 -->
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
    <input type="hidden">
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

<script>
// Define a function to validate the selected time
function validateTime() {
    // Get the value of the time input field
    var currentTimeInput = document.getElementById('time').value;
    
    // Get the current date and time
    var currentTime = new Date();
    
    // Create a new Date object for the selected time
    var selectedTime = new Date();
    
    // Split the input time into hours and minutes
    var selectedTimeParts = currentTimeInput.split(':');

    // Set the hours and minutes of the selected time
    selectedTime.setHours(selectedTimeParts[0]);
    selectedTime.setMinutes(selectedTimeParts[1]);

    // Check if the selected time is in the past
    var isPast = selectedTime < currentTime;
    
    // Check if the selected time is after 19:00
    var isPast19 = currentTimeInput > '19:00';

    // Get the error div
    var errorDiv = document.getElementById('time-order-error');

    // If the selected time is in the past, display an error message
    if (isPast) {
        errorDiv.innerHTML = "The time can not be in the past";
    // If the selected time is after 19:00, display an error message
    } else if(isPast19){
      errorDiv.innerHTML = "We will be closed by then.";
    // If the selected time is valid, clear any error messages
    } else {
        errorDiv.innerHTML = "";
    }
}
</script>