<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
    require "views/shared/_head.php" ;
    include 'processess/basket.php';
    require "user/user_obj.php";
  ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
</head>
<body>
  <?php require "views/shared/_header.php" ?>
  <h1 class="col-12 text-center">Reset your password</h1>

  <?php require "forms/_password-reset.php" ?>
</body>
</html>