<?php
/*
This helper function takes a product ID as an argument, connects to the database, 
and prepares a SQL statement to select all reviews for the product, along with the first name of the user 
who wrote each review. It then executes the statement and fetches the result. The result, which is a list of 
all reviews for the product, is returned by the function. Only the first name is selected from the users table 
to ensure privacy and that no other user details are exposed.
*/
?>
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