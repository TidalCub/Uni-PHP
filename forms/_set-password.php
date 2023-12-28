<?php
  require "forms/action/set-password_action.php"
?>
<div class="col-12 d-flex justify-content-center">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?token=<?php echo htmlspecialchars($_GET["token"]); ?>" class="col-11 col-md-4 col-lg-4 bg-light p-3 rounded shadow">
    <div class="form-group">
      <label>New Password</label>
      <input type="password" class="form-control" id="Password" name="Password" >
    </div>
    <div class="form-group">
      <label>Confirm Password</label>
      <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" >
    </div>
    <input type="hidden" name="token" value="<?php echo $_GET["token"] ?>">
    <input type="hidden" name="action" value="password-reset">
    <button class="btn btn-primary mt-2" type="submit">Save New Password</button>
    <div class="text-danger"><?php if(isset($message)){echo $message;}; ?></div>
  </form>
</div>