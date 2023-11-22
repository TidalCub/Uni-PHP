<!-- Login form, This allows a user to login into their account. Forms are placed outside of the html where they will be used to isolate
them and make maintaining and debugging easier. The form is submitted to its self by using  echo htmlspecialchars($_SERVER["PHP_SELF"]); -->

<form class="form form bg-light w-50 m-auto p-3 rounded" id="SignUpForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
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
  <a class="m-auto" href="signup.php">Dont have an account? SignUp for one here</a>
  <input type="hidden" name="redirect" value="<?=$redirectParam?>">
</from>