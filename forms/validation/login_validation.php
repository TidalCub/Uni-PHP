<?php 
  require "database/connect.php";
  require "validation.php";
  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = htmlspecialchars($_POST["Email"]);
    $password = htmlspecialchars($_POST["Password"]);

    $sql = "SELECT * FROM users WHERE email = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])){
          echo "you are now loged in";
          $_SESSION['user'] = $row["id"];
          header("Location: /");
        }else{
          echo "Incorrect Username or Password";
        }
      }
    } else {
      echo "Incorrect Username or Password";
    }
  }
?>

