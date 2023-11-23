<?php 
/*
  This action handles the submission of a new product. It inserts the product data into the database and displays a success message 
  if the insertion is successful. It also handles the file upload.
*/
?>
<?php 
//this function handles the file upload, by moving the file from the temp directory to the uploads directory
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

//this function gets the form data and sterilizes it, this is done here to follow the single principle of responsibility
function get_params(){
  return [
    'productName' => htmlspecialchars($_POST["ProductName"]),
    'productDescription' => htmlspecialchars($_POST["ProductDescription"]),
    'productPrice' => htmlspecialchars($_POST["ProductPrice"]),
    'categoryId' => htmlspecialchars($_POST["CategoryId"]),
  ];
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["table"]) ){
  if($_POST["table"] == "products"){
    require "database/connect.php";
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
  }
};
?>