<!-- Sign Up Form, this is a form used for the sign up of a user. Forms are placed outside of the html where they will be used to isolate
them and make maintaining and debugging easier. The form is submitted to its self by using  echo htmlspecialchars($_SERVER["PHP_SELF"]); -->

<?php 
  //the forms action is required here so that the form can be submitted to itself and the data can be validated and processed, and errors shown if needed
  require "forms/action/signup_action.php" 

?>
<form class="form bg-light w-50 m-auto p-3 rounded" id="SignUpForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
  <h1>Sign Up</h1>
  <div class="form-group">
    <label>Email</label>
    <input type="email" class="form-control" id="Email" name="Email" required>
  </div>

  <div class="form-group">
    <label>First Name</label>
    <input type="text" class="form-control" id="FirstName" name="FirstName" required>
  </div>

  <div class="form-group">
    <label>Last Name</label>
    <input type="text" class="form-control" id="LastName" name="LastName" required>
  </div>

  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" id="Password" name="Password" required>
  </div>

  <div class="form-group">
    <label>Confirm Password</label>
    <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" required>
  </div>

  
  <button type="submit" value="Submit" class="btn btn-primary w-100 mt-3">Sign Up</button>
  <a href="login.php">Already have an account? Login Here</a>
</form>
