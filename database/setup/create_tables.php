<?php

//a function that executes the sql command and saves a table
function save_table($sql){
  require 'database/connect.php';
  if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }
  $conn->close();
}

// Create the categories table
$sql = "CREATE TABLE IF NOT EXISTS categories (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  image_path VARCHAR(255)
)";

save_table($sql); //calls the function that saves the table

// Create the products table
$sql = "CREATE TABLE IF NOT EXISTS products (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  description VARCHAR(255),
  price DECIMAL(10,2) NOT NULL,
  category_id INT(6) UNSIGNED,
  image_path VARCHAR(255),
  FOREIGN KEY (category_id) REFERENCES categories(id)
)";

save_table($sql); //calls the function that saves the table

$sql = "CREATE TABLE IF NOT EXISTS users(
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(100) NOT NULL UNIQUE,
  first_name VARCHAR(20) NOT NULL,
  last_name VARCHAR(20) NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)";

save_table($sql); //calls the function that saves the table


?>