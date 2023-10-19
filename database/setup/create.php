<?php 
  $server = "localhost";
  $username = "root";
  $password = "password";
  $port = 3306;

  $conn = new mysqli($server, $username, $password, "", $port);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";

  $sql = "CREATE DATABASE IF NOT EXISTS alpaca_peruleon_cafe";
  if ($conn->query($sql) === FALSE) {
    echo "Error creating database: " . $conn->error;
  }
  $conn->close();
?>