<?php
  function is_Password_Strong($password){
    return !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
  }

  function validate_email($email){
    return !preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $email);
  }

  function validate_text($text){
    return !preg_match('/^[A-Za-z]+$/', $text);
  }
?>