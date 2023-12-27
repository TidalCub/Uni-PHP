<?php 
  require "processess/mailer.php";

  $email = new EmailSender;

  $email->sendEmail("Order Confirmed!", "Your Order has been confirmed", "leon.skinner@hotmail.co.uk")
  ?>