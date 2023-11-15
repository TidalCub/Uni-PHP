<?php 
require_once 'database/connect.php';

function file_handler() {
  $uploaddir = 'uploads/';
  $uploadfile = $uploaddir . basename($_FILES['product_image']['name']);

  if (move_uploaded_file($_FILES['product_image']['tmp_name'], $uploadfile)) {
      echo "File is valid, and was successfully uploaded.\n";
  } else {
      echo "Possible file upload attack!\n";
  }

  return basename($uploadfile);
}

function get_params(){
  return [
    'productName' => htmlspecialchars($_POST["ProductName"]),
    'productDescription' => htmlspecialchars($_POST["ProductDescription"]),
    'productPrice' => htmlspecialchars($_POST["ProductPrice"]),
    'categoryId' => htmlspecialchars($_POST["CategoryId"]),
  ];
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $path = file_handler();
  $params = get_params();
  if (is_numeric($params["productPrice"])) {
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, category_id, image_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdis", $params["productName"], $params["productDescription"], $params["productPrice"], $params["categoryId"], $path);
    header("Location: /manage.php");
    if ($stmt->execute()) {
      echo "Successfully Added";
      
    } else {
      echo "Error: " . $stmt->error;
    }

    $stmt->close();
  } 
    
    exit();
};
?>