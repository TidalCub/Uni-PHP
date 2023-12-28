<?php 
require "forms/action/validation.php";
require 'processess/mailer.php';

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "password-reset"){

  //validates password
  if(is_Password_Strong($_POST["Password"])){
    $message = "A Password Must Contain a Minimum of 8 Characters, Contain At Least One: Capital Letter, Number and a Special Character (@$!%*?&)";
    return;
  }elseif($_POST["ConfirmPassword"] != $_POST["Password"] ){
    $message = "The Passwords Do Not Match";
    return;
  }else{
    $password = $_POST["Password"];
    $token = $_POST["token"];
    $user_id = $tokenGenerator->decodeToken($token)["user_id"];
    updateUser($user_id, $password,$token);
  }

  
}

function updateUser($user_id, $newPassword, $token){
  
  require "database/connect.php";

  $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

  $sql = "UPDATE users SET password = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $hashedPassword, $user_id);

  if ($stmt->execute()) {
    header('Location: /');
  }  else{
    header("Location: /account_help.php?token=$token");
    echo "Somthing went wrong, try again";
  }
}

?>