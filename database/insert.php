<?php 
  require 'connect.php';

  $table = $_POST['table'];
  
  if($table === "categories") {
    $name = $_POST['name'];
    $sql = "INSERT INTO categories (name) VALUES ('$name')";
  }    
?>