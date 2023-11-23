<?php 
  /*
    This action hanels a new category submission. It inserts the category data into the database.
  */
?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["table"]) ) {
  if($_POST["table"] === "category"){
    require "database/connect.php";
    $categoryName = htmlspecialchars($_POST["CategoryName"]);
    $stmt = $conn->prepare("INSERT INTO categories (`name`) VALUES (?)");
    $stmt->bind_param("s", $categoryName);

    if ($stmt->execute()) {
      echo "Successfully Added";
      header("Location: /manage.php");
    } else {
      echo "Error: " . $stmt->error;
    }
  }
  
}
?>