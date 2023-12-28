<!-- Login form, This allows a user to login into their account. Forms are placed outside of the html where they will be used to isolate
them and make maintaining and debugging easier. The form is submitted to its self by using  echo htmlspecialchars($_SERVER["PHP_SELF"]); -->

<form class="form form bg-light col-11 col-md-7 col-lg-6 m-auto p-3 rounded" id="SignUpForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
  <h1>Login</h1> 
  <div class="form-group">
    <label>email</label>
    <input type="email" name="Email" class="form-control" id="email">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" name="Password" class="form-control" id="password">
  </div>
  <?php require "forms/action/login_action.php" ?>
  <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
  <div class="d-flex flex-row flex-wrap justify-content-between">
    <a class="" href="signup.php">Dont have an account? SignUp for one here</a>
    <a class="" href="/account_help.php">Reset Password</a>
  </div>
  
  <input type="hidden" name="redirect" value="<?=$redirectParam?>">
</from>