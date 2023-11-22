<!-- This file is the header partial that is used on all pages, it contains the header and navigation. -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="custom-header d-flex justify-content-between">
    <h1>Alpaca Peruleon Cafe <h6><span class="badge bg-secondary">PHP</span></h6></h1>
    <div class="cart">
      <a href="/checkout.php">
        <img src="images/cart.svg" style="height: 40px; width: auto;">
      </a>
    </div>
  </div>
  <div class="custom-nav">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/menu.php">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Alpacas</a>
        </li>
        <li class="nav-item"> 
          <!-- If the user is logged in, display the account link, if not display the login link -->
          <?php
          if (isset($_SESSION['user'])) {
            echo '<a class="nav-link" href="account.php">My Account </a>';
          } else {
            echo '<a class="nav-link" href="login.php">Login </a>';
          }
          ?>
          
        </li>
      </ul>
      
    </div>
  </div>
  <!-- If the time is between 7pm and 8am, display a banner saying the store is closed -->
  <?php if(date('H:i') > "19:00" && date('H:i') < "8:00") : ?>
    <div class="bg-danger col-12 p-2 pt-3 text-center closed-banner"><h5><i class='fas fa-exclamation-triangle'></i> We are currently closed. we will reopen at 8am tomorrow</h5></div>
  <?php endif; ?>
</nav>
