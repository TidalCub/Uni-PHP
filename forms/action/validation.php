<?php
/* This file is a base validation that can be used by any form action, with functions to validate specific inputs.
Regex is used here as it is a flexible and versatile way of checking inputs. It is used over PHP's built-in verifiers like verify_email because
this function is quite liberal in what it considers an email and can cause potential problems. */

  //This regex is used to check if a password is strong enough, it checks for a capital letter, a number, a special character and a minimum length of 8
  function is_Password_Strong($password){
    return !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
  }

  //This regex is used to check if a email is valid, ie it has a @ and a domain
  function validate_email($email){
    return !preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $email);
  }

  //This regex is used to check if a name is valid, ie it only contains letters
  function validate_text($text){
    return !preg_match('/^[A-Za-z]+$/', $text);
  }
?>