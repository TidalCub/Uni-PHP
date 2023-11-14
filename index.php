<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'views/shared/_head.php'; ?>
</head>
<body>
<?php include 'views/shared/_header.php'; ?>
  <div class="hero">
    <div class="landing-page">
      <img src="images/Desktop-landing-image.png" style="height:auto;width:100%;">
      <div class="wav-devider">
        <img src="images/green-wavy-devider.svg" style="height:auto;width:100%;">
      </div>
    </div>
  </div>
  
  <div class="content-green">
    <div class="d-flex flex-row flex-wrap justify-content-center col-12">
      <div class="start-order col-12 col-md-6 col-lg-6 text-center neutral-text">
        <?php
          // Get the current hour
          $currentHour = date('G');
          // Determine the message based on the current hour
          switch (true) {
              case ($currentHour >= 5 && $currentHour < 11):
                  $message = "Start your day right";
                  break;
          
              case ($currentHour >= 11 && $currentHour < 15):
                  $message = "Mid day reward";
                  break;
          
              case ($currentHour >= 15 && $currentHour < 17):
                  $message = "Afternoon treat";
                  break;
          
              case ($currentHour >= 17 && $currentHour <= 23):
                  $message = "Late evening pick me up";
                  break;
          
              default:
                  $message = "Start an order";
                  break;
          }

          ?>
        <h1 class="display-1"><?= $message ?></h1>
          <a class="link btn m-auto btn-primary col-8" href="/menu.php">
            <h2 class="lh-1 pt-2">Start An Order</h2>
          </a>
          <br>
          <a class="link neutral-text" href="/menu.php">
            Check out our menu
          </a>
      </div>
      <div class="previous-order col-11 col-md-6 col-lg-6 text-center">
        <div class="col3 card m-auto p-3 col-11 col-md-11 col-lg-11">
          <h1>Previous Order</h1>
          <hr>
          <ul class="list-unstyled">
            <li class="text-muted">No Previous Order, Once you've ordered, previous orders will appear here</li>
          </ul>
          <hr>
          <a class="link btn m-auto disabled" style="background-color: #D8D8D8; width:50%;">Re-Order</a>
        </div>
      </div>
    </div>
  </div>
  
  <div class="content" style="background-color: #F4A259; height:auto;">
    <div class="wav-devider-bottom">
      <img src="images/green-wavy-devider.svg" style="height:auto;width:100%;transform: rotate(180deg);">
    </div>
    <div class="display-2 col-12 text-center">About Us</div>
    <div class="col-12 text-center">
      <h4>We are Open:</h4>
      <div class="display-4">Monday - Friday<br>8am - 7pm</div> 
    </div>
    
  </div>
</body>
<?php include 'views/shared/_footer.php'; ?>