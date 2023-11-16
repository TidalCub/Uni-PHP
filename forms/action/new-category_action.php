<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["table"] === "category") {
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
?>