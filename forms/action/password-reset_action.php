<?php 
  require "forms/action/validation.php";
  require 'processess/mailer.php';
  require 'processess/token_obj.php';

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user = new user();
    $email = htmlspecialchars($_POST["Email"]);
    $message = "If the email is associated with an account, you will recieve an email. Check your junk folder.";
    if(validate_email($_POST["Email"])){
      $message = "The email is not valid";
      return;
    };
    $user = $user->find_user($email);
    if($user != null){
      
      $tokenGenerator = new TokenGenerator;
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