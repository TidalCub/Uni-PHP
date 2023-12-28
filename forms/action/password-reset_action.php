<?php 
  require "forms/action/validation.php";
  require 'processess/mailer.php';
  
  if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "password-reset-request"){
    $user = new user();
    $email = htmlspecialchars($_POST["Email"]);
    $message = "If the email is associated with an account, you will recieve an email. Check your junk folder.";
    if(validate_email($_POST["Email"])){
      $message = "The email is not valid";
      return;
    };
    $user = $user->find_user($email);
    if($user != null){
      
      
      $token = $tokenGenerator->generateToken($user->fetch_assoc()["id"]);

      $mailer = new EmailSender;
      $subject = "Password Reset";
      $data = [
        'TOKEN' => $token,
      ];
      $mailer->sendPasswordReset($subject, $email, $data);

    }
  }


?>