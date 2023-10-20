<?php
  require "database/connect.php";

  $passwords_match = false;
  $email = $first_name = $last_name = $password = "";
  $email_err = $name_err = $pass_err = $confirm_pass_err = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){


    //validates email
    if(!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', trim($_POST["Email"]))){ //check if email is in the format of an email
      $email_err = "Invalid Email, must look like example@provider.com";
    }else{
      //check if the email is in use
      $canidate_email = filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL);
      $sql = $conn->prepare("SELECT id FROM users WHERE email = ?");
      $sql->bind_param("s", $canidate_email);
      $sql->execute();
      $sql->bind_result($id);
      //If the email is in use tell the users, otherwise set email as the inputed email
      if ($sql->fetch()) {
          $email_err = "User Already found by this email";
      }else{
        $email = $canidate_email;
      }
    }

    //validates first name
    if(empty(trim($_POST["FirstName"])) || empty(trim($_POST["LastName"]))){
      $name_err = "please provide a first and last name";
    }elseif(!preg_match('/^[A-Za-z]+$/', trim($_POST["FirstName"])) || !preg_match('/^[A-Za-z]+$/', trim($_POST["LastName"]))){
      $name_err = "first and last name can only contain letters";
    }else{
      $first_name = trim($_POST["FirstName"]);
      $last_name = trim($_POST["LastName"]); // corrected variable name here
    }

    //validates password
    if(empty(trim($_POST["Password"]))){
      $pass_err = "Please Enter a Password";
    }elseif(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $_POST["Password"])){
      $pass_err = "A Password Must Contain a Minimum of 8 Characters, Contain At Least One: Capital Letter, Number and a Special Character (@$!%*?&)";
    }else{
      $password = trim($_POST["Password"]);
    }

    //confirms the password and the confirm password are the same
    if(empty($_POST["ConfirmPassword"])){
      $confirm_pass_err = "Please Confirm the Password";
    } elseif($_POST["ConfirmPassword"] != $_POST["Password"] ){
      $confirm_pass_err = "The Passwords Do Not Match";
    }else {
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
