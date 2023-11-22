<?php 
  function get_item($id){
    require_once "database/connect.php";
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
  }

  function get_rating($product){
    require "database/connect.php";
    $stmt = $conn->prepare("SELECT AVG(star_rating) AS average_rating FROM reviews WHERE product_id = ?");
    $stmt->bind_param("i", $product);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = $result->fetch_assoc();
    if(empty($result["average_rating"])){
      return 5;
    } 
    $average_rating = number_format($result["average_rating"], 1);
    return $average_rating;  

    
  }
?>