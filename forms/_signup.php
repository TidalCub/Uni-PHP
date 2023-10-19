<form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
  <div class="form-group">
    <label>email</label>
    <input type="email" class="form-control" id="Email">
  </div>
  
  <div class="form-group">
    <label>First Name</label>
    <input type="text" class="form-control" id="FirstName">
  </div>

  <div class="form-group">
    <label>Last Name</label>
    <input type="text" class="form-control" id="LastName">
  </div>

  <div class="form-group">
    <label>Username</label>
    <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
    <span class="invalid-feedback"><?php echo $username_err; ?></span>
  </div> 

  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" id="Password">
  </div>

  <div class="form-group">
    <label>Confirm Password</label>
    <input type="password" class="form-control" id="ConfirmPassword">
  </div>

  <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
</div>