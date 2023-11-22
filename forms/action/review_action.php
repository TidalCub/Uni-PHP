<?php 
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    require "database/connect.php";
    $comment = htmlspecialchars($_POST["product_review"]);
    $star_rating = $_POST["star_rating"];
    $product_id = $_POST["product_id"];

    if(isset($comment) && isset($star_rating) && isset($product_id)){
      $sql = "INSERT INTO reviews (comment, star_rating, product_id) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sii", $comment, $star_rating, $product_id);
      if ($stmt->execute()) {
        echo "<div class='bg-info'><h2>Review was sucessfuly added. Thank you</h2></div>";
      } else{
      }
    } else {
    }
  }
?>