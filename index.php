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
    <div class="d-flex flex-column col-12">
      <div class="start-order w-50 text-center neutral-text">
        <h1 class="display-1">Start Your Day Right</h1>
        <ul class="list-unstyled">
          <li>
            <a class="link btn m-auto" style="background-color: #F4A259; width:50%;" href="/categories">
              <h2 class="lh-1 pt-2">Start An Order</h2>
            </a>
          </li>
          <li>
            <a class="link neutral-text" href="#">
              Check out our menu
            </a>
          </li>
        </ul>
      </div>
      <div class="previous-order w-50 text-center">
        <div class="col3 card m-auto p-3" style="width: 30rem;">
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
  
  <div class="content" style="background-color: #F4A259; height:500px;">
    <div class="wav-devider-bottom">
      <img src="images/green-wavy-devider.svg" style="height:auto;width:100%;transform: rotate(180deg);">
    </div>
  </div>
</body>
<?php include 'views/shared/_footer.php'; ?>