<?php 
  require 'connect.php';

  $table = $_POST['table'];
  
  if($table === "categories") {
    $name = $_POST['name'];

    $sql = "INSERT INTO categories (name) VALUES ('$name')";
  
  } elseif($table === "products") {
    
    $path = file_handler();

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image_path = $path;
    if (is_numeric($price)) {
        $stmt = $conn->prepare("INSERT INTO products (name, description, price, category_id, image_path) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdis", $name, $description, $price, $category_id, $image_path);
    
        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "Successfully inserted into $name";
        } else {
            echo "Error: " . $stmt->error;
        }
    
        // Close the statement
        $stmt->close();
    }
    
    header("Location: ../sys/manage.php");
    exit();
  }    


  function file_handler() {
    $uploaddir = '../uploads/';
    $uploadfile = $uploaddir . basename($_FILES['product_image']['name']);

    if (move_uploaded_file($_FILES['product_image']['tmp_name'], $uploadfile)) {
        echo "File is valid, and was successfully uploaded.\n";
    } else {
        echo "Possible file upload attack!\n";
    }

    return basename($uploadfile);
  }
?>