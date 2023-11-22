<?php

// a function that executes the SQL command and saves a table
function save_table($sql){
  require 'database/connect.php';
  if ($conn->query($sql) === TRUE) {
    echo "Table created successfully \n";
  } else {
    echo "Error creating table: " . $conn->error . "\n";
  }
  $conn->close();
}

// Create the categories table
$sql = "CREATE TABLE IF NOT EXISTS categories (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  image_path VARCHAR(255)
)";

save_table($sql); // calls the function that saves the table

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

save_table($sql); // calls the function that saves the table

$sql = "CREATE TABLE IF NOT EXISTS users(
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(100) NOT NULL UNIQUE,
  first_name VARCHAR(20) NOT NULL,
  last_name VARCHAR(20) NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)";

save_table($sql); // calls the function that saves the table

$sql = "CREATE TABLE IF NOT EXISTS orders (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_id INT,
  stat varchar(20),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY(user_id) REFERENCES users(id)
);";

save_table($sql);

$sql = "CREATE TABLE IF NOT EXISTS order_items(
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  order_id INT,
  product_id INT(6) UNSIGNED,
  FOREIGN KEY(order_id) REFERENCES orders(id),
  FOREIGN KEY(product_id) REFERENCES products(id)
);";

save_table($sql);

$sql ="CREATE TABLE IF NOT EXISTS reviews(
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  product_id int(6) UNSIGNED,
  user_id INT,
  order_id INT,
  FOREIGN KEY(order_id) REFERENCES orders(id),
  FOREIGN KEY(product_id) REFERENCES products(id),
  FOREIGN KEY(user_id) REFERENCES users(id)
);";

save_table($sql);
?>
