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
  <?php 
    require 'processess/token_obj.php';
    $tokenGenerator = new TokenGenerator;

    if(isset($_GET["token"])){
      $token = htmlspecialchars($_GET["token"]);
      $result = $tokenGenerator->decodeToken($token);
      if($result["status"] = 200){
        require "forms/_set-password.php";
      } else{
        echo "Invalid Token";
      }

    } else{
      require "forms/_password-reset.php";
    }
    ?>
</body>
</html>