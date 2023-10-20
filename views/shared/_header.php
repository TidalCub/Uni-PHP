<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="custom-header d-flex justify-content-between">
    <h1>Alpaca Peruleon Cafe <h6><span class="badge bg-secondary">PHP</span></h6></h1>
    <div class="cart">
      <img src="images/cart.svg" style="height: 40px; width: auto;">
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
          <?php
          if (isset($_SESSION['user'])) {
            echo '<a class="nav-link" href="user/account.php">My Account </a>';
          } else {
            echo '<a class="nav-link" href="login.php">Login </a>';
          }
          ?>
          
        </li>
      </ul>
      
    </div>
  </div>
</nav>
