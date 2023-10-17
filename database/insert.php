<?php 
  require 'connect.php';

  $table = $_POST['table'];
  
  if($table === "categories") {
    $name = $_POST['name'];

    $sql = "INSERT INTO categories (name) VALUES ('$name')";
  }

  if ($conn->query($sql) === TRUE) {
    echo "Sucessfuly insertred into $name";
  }

  header("Location: ../sys/manage.php");
  exit();
?>