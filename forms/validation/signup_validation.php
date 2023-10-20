<?php
  require "database/connect.php";

  $passwords_match = false;
  $email = $first_name = $last_name = $password = "";
  $email_err = $name_err = $pass_err = $confirm_pass_err = "";

  function is_Password_Strong($password){
    return !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
  }

  function validate_email($email){
    return !preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $email);
  }

  function validate_text($text){
    return !preg_match('/^[A-Za-z]+$/', $text);
  }

  function email_exists($email){
    //check if the email is in use
    require "database/connect.php";
    $sql = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $sql->bind_result($id);
    return $sql->fetch();
  }
  
  if($_SERVER["REQUEST_METHOD"] == "POST"){

    //validates email
    $canidate_email = filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL);
    if(validate_email($_POST["Email"])){ //check if email is in the format of an email
      $email_err = "Invalid Email, must look like example@provider.com";
    }elseif(email_exists($canidate_email)){
      $email_err = "User Already found by this email";
    }else{
      $email = $canidate_email;
    }

    //validates first name and last name
    if(validate_text($_POST["FirstName"]) || validate_text($_POST["LastName"])){
      $name_err = "first and last name can only contain letters";
    }else{
      //asign and steralise first and last name
      $first_name = htmlspecialchars($_POST["FirstName"]); 
      $last_name = htmlspecialchars($_POST["LastName"]);
    }

    //validates password
    if(is_Password_Strong($_POST["Password"])){
      $pass_err = "A Password Must Contain a Minimum of 8 Characters, Contain At Least One: Capital Letter, Number and a Special Character (@$!%*?&)";
    }elseif($_POST["ConfirmPassword"] != $_POST["Password"] ){
      $confirm_pass_err = "The Passwords Do Not Match";
    }else{
      $password = trim($_POST["Password"]);
      $passwords_match = true; // Set to true if the passwords match
    }
    
    echo "<div class='w-100 alert alert-primary'>";
    if (!empty($email_err)) {
        echo $email_err . "<br>";
    }
    if (!empty($pass_err)) {
        echo $pass_err . "<br>";
    }
    if(!empty($name_err)){
      echo $name_err . "<br>";
    }
    if(!$passwords_match){
      echo $confirm_pass_err . "<br>";
    }
    echo "</div>";

    if (empty($email_err) && empty($name_err) && empty($pass_err) && $passwords_match) {
      $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

      $sql = "INSERT INTO users (email, first_name, last_name, password) VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $email, $first_name, $last_name, $hashedPassword);

      if ($stmt->execute()) {
        header('Location: /');
      }  else{
        echo "An error occurred";
      }

      $stmt->close();
    }
  }
?>
