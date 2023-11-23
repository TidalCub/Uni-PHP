<?php 
  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) ){
    if($_POST["action"] == "update_product"){
      if(!isset($_POST["product_id"])){
        echo "Error id not set";
        return;
      }
      require "database/connect.php";
      $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, category_id = ? WHERE id = ?");
      $stmt->bind_param("ssdii", $_POST["name"], $_POST["description"], $_POST["price"], $_POST["categoryid"], $_POST["product_id"]);
      if ($stmt->execute()) {
        echo "<div class='alert alert-success p-3'>Successfuly updated product: ". $_POST["name"] ."</div>";
        
      } else {
        echo "Error: " . $stmt->error;
      }


    }
  }
?>