<?php 
  
  function get_all_reviews($product){
    require "database/connect.php";
    $stmt = $conn->prepare("SELECT * FROM reviews WHERE product_id = ?");
    $stmt->bind_param("i", $product);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
  }
?>