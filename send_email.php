<?php 
  $to = 'leon.skinner@hotmail.com';
  $subject = 'Subject of the email';
  $message = 'Hello, this is a test email.';
  $headers = 'From: orders@mmi.leon-skinner.dev' . "\r\n" .
    'Reply-To: orders@mmi.leon-skinner.dev' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

  if(mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully";
  } else {
    echo "Email sending failed";
  }

?>