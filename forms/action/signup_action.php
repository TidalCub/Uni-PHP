<?php
/* 
  This file handles the form submission for user sign up.
  It validates the user input for email, first name, last name, and password.
  If the input is valid, it inserts the user data into the database.
  If there are any errors, it displays the error messages.
 */
?>
<?php
  require "database/connect.php";
  require "validation.php";

  //set variables to empty values and set error messages to empty
  $passwords_match = false; 
  $email = $first_name = $last_name = $password = "";
  $email_err = $name_err = $pass_err = $confirm_pass_err = "";

  //checks if the email is already in use
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

    //validates email, if the email is valid, it checks if the email is already in use, then if it is not, it assigns the email to the variable
    $candidate_email = filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL);
    if(validate_email($_POST["Email"])){ //check if email is in the format of an email
      $email_err = "Invalid Email, must look like example@provider.com";
    }elseif(email_exists($candidate_email)){
      $email_err = "User Already found by this email";
    }else{
      $email = $candidate_email;
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
      $password = $_POST["Password"];
      $passwords_match = true; // Set to true if the passwords match
    }

    //if there are no errors insert into users table
    if (empty($email_err) && empty($name_err) && empty($pass_err) && $passwords_match) {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      $sql = "INSERT INTO users (email, first_name, last_name, password) VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $email, $first_name, $last_name, $hashedPassword);
        
      if ($stmt->execute()) {
        header('Location: /');
      }  else{
        echo "An error occurred";
      }

      $stmt->close();
    } else{
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
    }
  }
?>
