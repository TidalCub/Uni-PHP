<?php
  require "forms/action/password-reset_action.php"
?>
<div class="col-12 d-flex justify-content-center">
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="col-11 col-md-4 col-lg-4 bg-light p-3 rounded shadow">
    <div class="form-group">
      <label>Your Email:</label>
      <input type="email" class="form-control" id="Email" name="Email" >
    </div>
    <button class="btn btn-primary mt-2" type="submit">Request Password Reset</button>
    <div class="text-danger"><?php if(isset($message)){echo $message;}; ?></div>
  </form>
</div>