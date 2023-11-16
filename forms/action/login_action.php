<?php 
  require "database/connect.php";
  require "validation.php";
  require "user/user_obj.php";
  $redirectParam = isset($_GET['redirect']) ? $_GET['redirect'] : '';

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user = new user();
    $email = htmlspecialchars($_POST["Email"]);
    $password = htmlspecialchars($_POST["Password"]);
    if($user->login($email, $password)){
      echo "you have now signed in";
      header("Location: /$redirectParam");
      return;
    }
    echo "The email or password did not match";
  }
?>

