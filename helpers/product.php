<?php
//This script contains two helper functions related to product details and ratings
?>
<?php 
/*This function takes a product ID as an argument, connects to the database, and prepares a SQL statement to 
select the product with the given ID. It then executes the statement and fetches the result. The result, which 
is the product details, is returned by the function. */
  function get_item($id){
    require_once "database/connect.php";
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
  }

  /*This function takes a product ID as an argument, connects to the database, and prepares a SQL statement to calculate 
  the average rating of the product from all its reviews. It then executes the statement and fetches the result. If the p
  product has no reviews, the function returns a default rating of 5. Otherwise, it returns the average rating rounded to one decimal place. */
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