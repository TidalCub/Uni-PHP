<?php 
  require 'connect.php';

  $table = $_POST['table'];
  
  if($table === "categories") {
    $name = $_POST['name'];

    $sql = "INSERT INTO categories (name) VALUES ('$name')";
  } elseif($table === "products") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $price = (float)$price;
    echo $name . $description . $price . $category_id;
    if (is_numeric($price)) {
      $sql = "INSERT INTO products (name, description, price, category_id) VALUES ('$name','$description',$price,$category_id)";
    }
  }

  if ($conn->query($sql) === TRUE) {
    echo "Sucessfuly insertred into $name";
  }

  header("Location: ../sys/manage.php");
  exit();
?>