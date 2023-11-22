<?php 
  
  function get_all_reviews($product){
    require "database/connect.php";
    $stmt = $conn->prepare(
      "SELECT reviews.id, reviews.comment, reviews.star_rating, users.first_name
      FROM reviews
      JOIN users ON reviews.user_id = users.id
      WHERE reviews.product_id = ?;"
    );
    $stmt->bind_param("i", $product);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
  }

  
?>