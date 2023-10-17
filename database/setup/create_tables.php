<?php
require 'database/connect.php';

// Create the categories table
$sql = "CREATE TABLE categories (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
  echo "Table categories created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

// Create the products table
$sql = "CREATE TABLE products (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  description VARCHAR(255),
  price DECIMAL NOT NULL,
  category_id INT(6) UNSIGNED,
  FOREIGN KEY (category_id) REFERENCES categories(id)
)";

if ($conn->query($sql) === TRUE) {
  echo "Table products created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>