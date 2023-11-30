<?php 
  require "../helpers/product.php";
  header("Content-Type: application/json");
  if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if(isset($_GET["product_id"])){
      $product = get_item(htmlspecialchars($_GET["product_id"]));
      http_response_code(200);
      echo json_encode([
        "product_id" => $product["id"],
        "name" => $product["name"],
        "description" => $product["description"],
        "price" => $product["price"],
        "image_path" => $product["image_path"]
      ]);
    }else {
      http_response_code(400);
      echo json_encode(["error" => "Product ID not provided"]);
    }
  } else{
    http_response_code(404);
  }
?>